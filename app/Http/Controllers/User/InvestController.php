<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Lib\HyipLab;
use App\Models\GatewayCurrency;
use App\Models\Invest;
use App\Models\LuckyWheelSpin;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    public function invest(Request $request)
    {
        $request->validate([
            'amount'        => 'required|min:0',
            'plan_id'       => 'required',
            'wallet_type'   => 'required',
        ]);
        $user   = auth()->user();
        $plan   = Plan::where('status',1)->findOrFail($request->plan_id);
        $amount = $request->amount;

        //Check limit
        if($plan->fixed_amount > 0){
            if ($amount != $plan->fixed_amount) {
                $notify[] = ['error','Please check the investment limit'];
                return back()->withNotify($notify);
            }
        }else{
            if ($request->amount < $plan->minimum || $request->amount > $plan->maximum) {
                $notify[] = ['error','Please check the investment limit'];
                return back()->withNotify($notify);
            }
        }

        // Always invest from the total balance (deposit_wallet + interest_wallet)
        $totalBalance = $user->deposit_wallet + $user->interest_wallet;

        if ($amount > $totalBalance) {
            $notify[] = ['error', 'Solde insuffisant. Veuillez recharger votre compte.'];
            return back()->withNotify($notify);
        }

        // If deposit_wallet alone is insufficient, pull the shortfall from interest_wallet
        // then top up deposit_wallet so HyipLab can deduct the full amount cleanly
        if ($amount > $user->deposit_wallet) {
            $shortfall = $amount - $user->deposit_wallet;
            $user->interest_wallet -= $shortfall;
            $user->deposit_wallet  += $shortfall; // deposit_wallet now == $amount exactly
            $user->save();
        }

        $hyip = new HyipLab($user, $plan);
        $hyip->invest($amount, 'deposit_wallet');

        // Attribuer 1 tour de roue à l'acheteur
        $spinData = LuckyWheelSpin::firstOrCreate(
            ['user_id' => $user->id],
            ['spins_available' => 0, 'total_spins_earned' => 0, 'total_spins_used' => 0]
        );
        $spinData->spins_available++;
        $spinData->total_spins_earned++;
        $spinData->save();

        // Attribuer 1 tour de roue au parrain si c'est un filleul de niveau 1
        if ($user->ref_by) {
            $referrer = User::find($user->ref_by);
            if ($referrer) {
                $referrerSpin = LuckyWheelSpin::firstOrCreate(
                    ['user_id' => $referrer->id],
                    ['spins_available' => 0, 'total_spins_earned' => 0, 'total_spins_used' => 0]
                );
                $referrerSpin->spins_available++;
                $referrerSpin->total_spins_earned++;
                $referrerSpin->save();
            }
        }

        $notify[] = ['success', 'Investissement effectué avec succès ! Vous avez reçu 1 tour de roue de la chance.'];
        return back()->withNotify($notify);
    }

    public function statistics()
    {
        $pageTitle = 'Invest Statistics';
        $invests    = Invest::where('user_id',auth()->id())->orderBy('id','desc')->with('plan')->where('status',1)->paginate(getPaginate(10));
        $activePlan = Invest::where('user_id', auth()->id())->where('status', 1)->count();

        $investChart = Invest::where('user_id',auth()->id())->with('plan')->groupBy('plan_id')->select('plan_id')->selectRaw("SUM(amount) as investAmount")->orderBy('investAmount', 'desc')->get();
        return view($this->activeTemplate.'user.invest_statistics',compact('pageTitle','invests','investChart', 'activePlan'));
    }

    public function log()
    {
        $pageTitle = 'Invest Logs';
        $invests = Invest::where('user_id',auth()->id())->orderBy('id','desc')->with('plan')->paginate(getPaginate());
        return view($this->activeTemplate.'user.invests',compact('pageTitle','invests'));
    }
}
