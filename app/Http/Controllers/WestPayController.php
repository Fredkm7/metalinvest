<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Lib\HyipLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WestPayController extends Controller
{
    const METHOD_CODE = 901; // WestPay auto gateway code

    public function showForm()
    {
        $pageTitle = 'Recharger mon compte';
        $min = (int) config('westpay.min_amount', 500);
        $max = (int) config('westpay.max_amount', 500000);
        return view($this->activeTemplate . 'user.payment.westpay', compact('pageTitle', 'min', 'max'));
    }

    public function initiate(Request $request)
    {
        $min = (int) config('westpay.min_amount', 500);
        $max = (int) config('westpay.max_amount', 500000);

        $request->validate([
            'amount' => "required|integer|min:{$min}|max:{$max}",
        ]);

        $amount = (int) $request->amount;
        $user   = auth()->user();

        $deposit                  = new Deposit();
        $deposit->user_id         = $user->id;
        $deposit->method_code     = self::METHOD_CODE;
        $deposit->method_currency = 'XOF';
        $deposit->amount          = $amount;
        $deposit->charge          = 0;
        $deposit->rate            = 1;
        $deposit->final_amo       = $amount;
        $deposit->btc_amo         = 0;
        $deposit->btc_wallet      = '';
        $deposit->trx             = getTrx();
        $deposit->status          = 0;
        $deposit->save();

        session()->put('WestPayTrx', $deposit->trx);

        $returnUrl = route('user.deposit.westpay.return') . '?trx=' . $deposit->trx;

        $westpayUrl = 'https://westpay.cloud/pay?' . http_build_query([
            'merchant' => env('WESTPAY_MERCHANT_SLUG', 'novatek'),
            'amount'   => $amount,
            'country'  => env('WESTPAY_COUNTRY', 'Togo'),
            'redirect' => $returnUrl,
        ]);

        return redirect($westpayUrl);
    }

    public function returnHandler(Request $request)
    {
        $trx    = $request->query('trx');
        $status = $request->query('status');
        $ref    = $request->query('ref');
        $amount = $request->query('amount');

        if (!$trx) {
            return redirect()->route('user.deposit.westpay.form')
                ->with('error', 'Paramètres manquants.');
        }

        $deposit = Deposit::where('trx', $trx)
            ->where('user_id', auth()->id())
            ->where('method_code', self::METHOD_CODE)
            ->first();

        if (!$deposit) {
            return redirect()->route('user.deposit.westpay.form')
                ->with('error', 'Transaction introuvable.');
        }

        // Store WestPay ref so webhook can find this deposit
        if ($ref && $deposit->btc_wallet !== $ref) {
            $deposit->btc_wallet = $ref;
            $deposit->save();
        }

        // Check if webhook already processed this payment
        if ($deposit->status == 1) {
            $notify[] = ['success', 'Dépôt de ' . showAmount($deposit->amount, 0) . ' FCFA crédité avec succès !'];
            return redirect()->route('user.home')->withNotify($notify);
        }

        // Check if a webhook arrived before this redirect
        if ($ref) {
            $cachedPayload = Cache::get('westpay_wh_' . $ref);
            if ($cachedPayload) {
                $this->creditDeposit($deposit);
                Cache::forget('westpay_wh_' . $ref);
                $notify[] = ['success', 'Dépôt de ' . showAmount($deposit->amount, 0) . ' FCFA crédité avec succès !'];
                return redirect()->route('user.home')->withNotify($notify);
            }
        }

        if ($status === 'success') {
            $pageTitle = 'Paiement en cours de traitement';
            return view($this->activeTemplate . 'user.payment.westpay_pending', compact('pageTitle', 'deposit'));
        }

        $notify[] = ['error', 'Le paiement a échoué ou a été annulé.'];
        return redirect()->route('user.deposit.westpay.form')->withNotify($notify);
    }

    public function webhook(Request $request)
    {
        $event = $request->header('X-RobotPay-Event');
        $data  = $request->json()->all();

        if ($event !== 'payment.confirmed') {
            return response()->json(['received' => true]);
        }

        $txId   = $data['txId']   ?? null;
        $amount = $data['amount'] ?? null;

        if (!$txId) {
            return response()->json(['error' => 'txId manquant'], 400);
        }

        // Find the deposit by WestPay ref (btc_wallet)
        $deposit = Deposit::where('btc_wallet', $txId)
            ->where('method_code', self::METHOD_CODE)
            ->where('status', 0)
            ->first();

        if ($deposit) {
            $this->creditDeposit($deposit);
            Cache::forget('westpay_wh_' . $txId);
        } else {
            // Redirect hasn't run yet — cache payload for up to 5 minutes
            Cache::put('westpay_wh_' . $txId, $data, now()->addMinutes(5));
        }

        return response()->json(['received' => true]);
    }

    private function creditDeposit(Deposit $deposit)
    {
        if ($deposit->status != 0) {
            return; // Already processed (idempotency guard)
        }

        $deposit->status = 1;
        $deposit->save();

        $user = User::find($deposit->user_id);
        $user->deposit_wallet += $deposit->amount;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $deposit->user_id;
        $transaction->amount       = $deposit->amount;
        $transaction->post_balance = $user->deposit_wallet;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Dépôt via WestPay (Mobile Money)';
        $transaction->trx          = $deposit->trx;
        $transaction->wallet_type  = 'deposit_wallet';
        $transaction->remark       = 'deposit';
        $transaction->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'Dépôt WestPay confirmé — ' . $deposit->amount . ' FCFA';
        $adminNotification->click_url = urlPath('admin.deposit.successful');
        $adminNotification->save();

        $general = GeneralSetting::first();
        if ($general->deposit_commission) {
            HyipLab::levelCommission($user, $deposit->amount, 'deposit_commission', $deposit->trx, $general);
        }
    }
}
