<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\HyipLab;
use App\Models\AdminNotification;
use App\Models\Invest;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use App\Models\WithdrawalAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdrawMoney()
    {
        $method    = WithdrawMethod::where('status', 1)->first();
        $accounts  = WithdrawalAccount::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        $pageTitle = 'Retrait';

        $isHoliday      = HyipLab::isHoliDay(now()->toDateTimeString(), gs());
        $nextWorkingDay = now()->toDateString();

        if ($isHoliday && !gs()->holiday_withdraw) {
            $nextWorkingDay = HyipLab::nextWorkingDay(24);
            $nextWorkingDay = Carbon::parse($nextWorkingDay)->toDateString();
        }

        return view($this->activeTemplate . 'user.withdraw.methods', compact('pageTitle', 'method', 'accounts', 'isHoliday', 'nextWorkingDay'));
    }

    public function withdrawStore(Request $request)
    {
        // ── Restrictions ──────────────────────────────────────────────────
        if (now()->dayOfWeek === 0) {
            $notify[] = ['error', 'Les retraits ne sont pas disponibles le dimanche.'];
            return back()->withNotify($notify);
        }
        $hour = now()->hour;
        if ($hour < 9 || $hour >= 18) {
            $notify[] = ['error', 'Les retraits sont disponibles uniquement de 9h00 à 18h00.'];
            return back()->withNotify($notify);
        }
        if (!Invest::where('user_id', auth()->id())->exists()) {
            $notify[] = ['error', 'Vous devez avoir acheté un produit NHR pour pouvoir effectuer un retrait.'];
            return back()->withNotify($notify);
        }
        if (HyipLab::isHoliDay(now()->toDateTimeString(), gs()) && !gs()->holiday_withdraw) {
            $notify[] = ['error', 'Aujourd\'hui est férié. Les retraits sont indisponibles.'];
            return back()->withNotify($notify);
        }
        $todayWithdrawals = Withdrawal::where('user_id', auth()->id())
            ->where('status', '!=', 0)->whereDate('created_at', today())->count();
        if ($todayWithdrawals >= 2) {
            $notify[] = ['error', 'Vous avez atteint la limite de 2 retraits par jour.'];
            return back()->withNotify($notify);
        }

        // ── Validation ────────────────────────────────────────────────────
        $this->validate($request, [
            'account_id'           => 'required|integer',
            'amount'               => 'required|numeric',
            'transaction_password' => 'required',
        ]);

        $method  = WithdrawMethod::where('status', 1)->firstOrFail();
        $user    = auth()->user();
        $account = WithdrawalAccount::where('id', $request->account_id)
            ->where('user_id', $user->id)->firstOrFail();

        // Mot de passe de transaction
        if (!$user->transaction_password_set || !\Illuminate\Support\Facades\Hash::check($request->transaction_password, $user->transaction_password)) {
            $notify[] = ['error', 'Mot de passe de transaction incorrect.'];
            return back()->withNotify($notify);
        }

        if ($request->amount < $method->min_limit) {
            $notify[] = ['error', 'Le montant est inférieur au minimum autorisé (' . showAmount($method->min_limit, 0) . ' ' . gs()->cur_text . ').'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Le montant dépasse le maximum autorisé (' . showAmount($method->max_limit, 0) . ' ' . gs()->cur_text . ').'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $user->interest_wallet) {
            $notify[] = ['error', 'Solde insuffisant.'];
            return back()->withNotify($notify);
        }

        // ── Calculs ───────────────────────────────────────────────────────
        $charge      = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = $afterCharge * $method->rate;

        // ── Informations du compte bénéficiaire ──────────────────────────
        $countryNames = ['CM' => 'Cameroun', 'CI' => "Côte d'Ivoire", 'BJ' => 'Bénin', 'BF' => 'Burkina Faso', 'TG' => 'Togo'];
        $userData = [
            (object)['name' => 'Pays',      'type' => 'text', 'value' => $countryNames[$account->country] ?? $account->country],
            (object)['name' => 'Opérateur', 'type' => 'text', 'value' => $account->operator],
            (object)['name' => 'Numéro',    'type' => 'text', 'value' => $account->phone],
        ];

        // ── Création du retrait (statut 2 = en attente validation admin) ─
        $withdraw                      = new Withdrawal();
        $withdraw->method_id           = $method->id;
        $withdraw->user_id             = $user->id;
        $withdraw->amount              = $request->amount;
        $withdraw->currency            = $method->currency;
        $withdraw->rate                = $method->rate;
        $withdraw->charge              = $charge;
        $withdraw->final_amount        = $finalAmount;
        $withdraw->after_charge        = $afterCharge;
        $withdraw->trx                 = getTrx();
        $withdraw->status              = 2;
        $withdraw->withdraw_information = $userData;
        $withdraw->save();

        // ── Débit du portefeuille ─────────────────────────────────────────
        $user->interest_wallet -= $request->amount;
        $user->save();

        // ── Transaction ───────────────────────────────────────────────────
        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $request->amount;
        $transaction->post_balance = $user->interest_wallet;
        $transaction->charge       = $charge;
        $transaction->trx_type     = '-';
        $transaction->details      = showAmount($finalAmount) . ' ' . $method->currency . ' Withdraw Via ' . $method->name;
        $transaction->trx          = $withdraw->trx;
        $transaction->wallet_type  = 'interest_wallet';
        $transaction->remark       = 'withdraw';
        $transaction->save();

        // ── Notification admin ────────────────────────────────────────────
        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'New withdraw request from ' . $user->username;
        $adminNotification->click_url = urlPath('admin.withdraw.details', $withdraw->id);
        $adminNotification->save();

        notify($user, 'WITHDRAW_REQUEST', [
            'method_name'     => $method->name,
            'method_currency' => $method->currency,
            'method_amount'   => showAmount($finalAmount),
            'amount'          => showAmount($request->amount),
            'charge'          => showAmount($charge),
            'rate'            => showAmount($method->rate),
            'trx'             => $withdraw->trx,
            'post_balance'    => showAmount($user->interest_wallet),
        ]);

        $notify[] = ['success', 'Votre demande de retrait a été envoyée avec succès.'];
        return to_route('user.withdraw.history')->withNotify($notify);
    }

    /**
     * Trouve la demande de retrait en attente pour l'utilisateur connecté.
     * Cherche d'abord par trx en session, puis par le dernier pending de l'user.
     */
    private function findPendingWithdrawal()
    {
        $userId = auth()->id();

        // 1. Essai via session wtrx (précis)
        $trx = session()->get('wtrx');
        if ($trx) {
            $w = Withdrawal::with('method', 'user')
                ->where('trx', $trx)
                ->where('user_id', $userId)
                ->where('status', 0)
                ->first();
            if ($w) return $w;
        }

        // 2. Fallback : dernier retrait pending de cet utilisateur
        return Withdrawal::with('method', 'user')
            ->where('user_id', $userId)
            ->where('status', 0)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function withdrawPreview()
    {
        $withdraw = $this->findPendingWithdrawal();

        if (!$withdraw) {
            $notify[] = ['error', 'Aucune demande de retrait en attente. Veuillez recommencer.'];
            return to_route('user.withdraw')->withNotify($notify);
        }

        $accounts  = WithdrawalAccount::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        $pageTitle = 'Withdraw Preview';
        return view($this->activeTemplate . 'user.withdraw.preview', compact('pageTitle', 'withdraw', 'accounts'));
    }

    public function withdrawSubmit(Request $request)
    {
        $withdraw = $this->findPendingWithdrawal();

        if (!$withdraw) {
            $notify[] = ['error', 'Demande de retrait introuvable. Veuillez recommencer depuis le début.'];
            return to_route('user.withdraw')->withNotify($notify);
        }

        $method = $withdraw->method;
        if (!$method || $method->status == 0) {
            $notify[] = ['error', 'La méthode de retrait n\'est plus disponible.'];
            return to_route('user.withdraw')->withNotify($notify);
        }

        $request->validate([
            'account_id' => 'required|integer',
        ]);

        // Charger le compte de retrait enregistré
        $account = WithdrawalAccount::where('id', $request->account_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $countryNames = ['CM' => 'Cameroun', 'CI' => "Côte d'Ivoire", 'BJ' => 'Bénin', 'BF' => 'Burkina Faso', 'TG' => 'Togo'];
        $userData = [
            (object)['name' => 'Pays',      'type' => 'text', 'value' => $countryNames[$account->country] ?? $account->country],
            (object)['name' => 'Opérateur', 'type' => 'text', 'value' => $account->operator],
            (object)['name' => 'Numéro',    'type' => 'text', 'value' => $account->phone],
        ];

        $user = auth()->user();
        if ($user->ts) {
            $response = verifyG2fa($user, $request->authenticator_code);
            if (!$response) {
                $notify[] = ['error', 'Wrong verification code'];
                return back()->withNotify($notify);
            }
        }

        if ($withdraw->amount > $user->interest_wallet) {
            $notify[] = ['error', 'Your request amount is larger then your current balance.'];
            return back()->withNotify($notify);
        }

        $withdraw->status               = 2;
        $withdraw->withdraw_information = $userData;
        $withdraw->save();
        $user->interest_wallet -= $withdraw->amount;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $withdraw->user_id;
        $transaction->amount       = $withdraw->amount;
        $transaction->post_balance = $user->interest_wallet;
        $transaction->charge       = $withdraw->charge;
        $transaction->trx_type     = '-';
        $transaction->details      = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
        $transaction->trx          = $withdraw->trx;
        $transaction->wallet_type  = 'interest_wallet';
        $transaction->remark       = 'withdraw';
        $transaction->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'New withdraw request from ' . $user->username;
        $adminNotification->click_url = urlPath('admin.withdraw.details', $withdraw->id);
        $adminNotification->save();

        notify($user, 'WITHDRAW_REQUEST', [
            'method_name'     => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount'   => showAmount($withdraw->final_amount),
            'amount'          => showAmount($withdraw->amount),
            'charge'          => showAmount($withdraw->charge),
            'rate'            => showAmount($withdraw->rate),
            'trx'             => $withdraw->trx,
            'post_balance'    => showAmount($user->interest_wallet),
        ]);

        $notify[] = ['success', 'Withdraw request sent successfully'];
        return to_route('user.withdraw.history')->withNotify($notify);
    }

    public function withdrawLog(Request $request)
    {
        $pageTitle = "Withdraw Log";
        $withdraws = Withdrawal::where('user_id', auth()->id())->where('status', '!=', 0);
        if ($request->search) {
            $withdraws = $withdraws->where('trx', $request->search);
        }
        $withdraws = $withdraws->with('method')->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.withdraw.log', compact('pageTitle', 'withdraws'));
    }
}
