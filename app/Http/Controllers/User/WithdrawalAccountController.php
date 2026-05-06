<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalAccount;
use Illuminate\Http\Request;

class WithdrawalAccountController extends Controller
{
    public function index()
    {
        $pageTitle = 'Mes comptes de retrait';
        $accounts  = WithdrawalAccount::where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();
        return view($this->activeTemplate . 'user.withdrawal_accounts.index', compact('pageTitle', 'accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country'  => 'required|in:CM,CI,BJ,BF,TG',
            'operator' => 'required|string|max:60',
            'phone'    => 'required|string|max:25',
            'label'    => 'nullable|string|max:60',
        ]);

        $count = WithdrawalAccount::where('user_id', auth()->id())->count();
        if ($count >= 1) {
            $notify[] = ['error', 'Vous ne pouvez enregistrer qu\'un seul compte de retrait. Supprimez l\'existant pour en ajouter un nouveau.'];
            return back()->withNotify($notify);
        }

        WithdrawalAccount::create([
            'user_id'  => auth()->id(),
            'country'  => $request->country,
            'operator' => $request->operator,
            'phone'    => $request->phone,
            'label'    => $request->label ?: null,
        ]);

        $notify[] = ['success', 'Compte de retrait ajouté avec succès.'];
        return back()->withNotify($notify);
    }

    public function destroy($id)
    {
        $account = WithdrawalAccount::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $account->delete();

        $notify[] = ['success', 'Compte supprimé.'];
        return back()->withNotify($notify);
    }
}
