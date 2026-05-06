<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LuckyWheelPrize;
use App\Models\LuckyWheelResult;
use App\Models\LuckyWheelSpin;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LuckyWheelController extends Controller
{
    public function index()
    {
        $pageTitle = 'Roue de la Chance';
        $user      = auth()->user();
        $prizes    = LuckyWheelPrize::where('status', 1)->get();
        $spinData  = LuckyWheelSpin::firstOrCreate(
            ['user_id' => $user->id],
            ['spins_available' => 0, 'total_spins_earned' => 0, 'total_spins_used' => 0]
        );
        $history = LuckyWheelResult::where('user_id', $user->id)->latest()->take(10)->get();
        return view($this->activeTemplate . 'user.lucky_wheel', compact('pageTitle', 'prizes', 'spinData', 'history'));
    }

    public function spin(Request $request)
    {
        $user     = auth()->user();
        $spinData = LuckyWheelSpin::firstOrCreate(
            ['user_id' => $user->id],
            ['spins_available' => 0, 'total_spins_earned' => 0, 'total_spins_used' => 0]
        );

        if ($spinData->spins_available < 1) {
            return response()->json(['error' => 'Vous n\'avez pas de tours disponibles.'], 422);
        }

        $prizes = LuckyWheelPrize::where('status', 1)->get();
        if ($prizes->isEmpty()) {
            return response()->json(['error' => 'Aucun prix disponible.'], 422);
        }

        // Tirage au sort pondéré par probabilité
        $totalProb = $prizes->sum('probability');
        $rand      = mt_rand(0, (int)($totalProb * 100)) / 100;
        $cumul     = 0;
        $winner    = $prizes->last();
        foreach ($prizes as $prize) {
            $cumul += $prize->probability;
            if ($rand <= $cumul) {
                $winner = $prize;
                break;
            }
        }

        // Décrémenter les tours
        $spinData->spins_available--;
        $spinData->total_spins_used++;
        $spinData->save();

        // Créditer le prix
        $credited = false;
        if ($winner->prize_type === 'fcfa') {
            $user->interest_wallet += $winner->prize_value;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $winner->prize_value;
            $transaction->charge       = 0;
            $transaction->post_balance = $user->interest_wallet;
            $transaction->trx_type     = '+';
            $transaction->trx          = getTrx();
            $transaction->wallet_type  = 'interest_wallet';
            $transaction->remark       = 'lucky_wheel';
            $transaction->details      = 'Roue de la chance : ' . $winner->label;
            $transaction->save();
            $credited = true;
        } elseif ($winner->prize_type === 'bonus_percent') {
            $bonusAmount = $user->deposit_wallet * ($winner->prize_value / 100);
            if ($bonusAmount > 0) {
                $user->interest_wallet += $bonusAmount;
                $user->save();
                $transaction               = new Transaction();
                $transaction->user_id      = $user->id;
                $transaction->amount       = $bonusAmount;
                $transaction->charge       = 0;
                $transaction->post_balance = $user->interest_wallet;
                $transaction->trx_type     = '+';
                $transaction->trx          = getTrx();
                $transaction->wallet_type  = 'interest_wallet';
                $transaction->remark       = 'lucky_wheel';
                $transaction->details      = 'Roue de la chance bonus ' . $winner->prize_value . '%';
                $transaction->save();
            }
            $credited = true;
        } elseif ($winner->prize_type === 'spins') {
            $spinData->spins_available += (int)$winner->prize_value;
            $spinData->total_spins_earned += (int)$winner->prize_value;
            $spinData->save();
            $credited = true;
        }

        $result            = new LuckyWheelResult();
        $result->user_id   = $user->id;
        $result->prize_id  = $winner->id;
        $result->prize_label = $winner->label;
        $result->prize_value = $winner->prize_value;
        $result->prize_type  = $winner->prize_type;
        $result->credited    = $credited ? 1 : 0;
        $result->save();

        return response()->json([
            'success'      => true,
            'prize'        => $winner->label,
            'prize_index'  => $prizes->search(fn($p) => $p->id === $winner->id),
            'prize_type'   => $winner->prize_type,
            'prize_value'  => $winner->prize_value,
            'spins_left'   => $spinData->spins_available,
        ]);
    }
}
