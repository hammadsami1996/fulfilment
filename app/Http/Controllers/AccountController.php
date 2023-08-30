<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Counter;
use App\Models\Finance_transaction;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'accountcode' => 'required|max:100',
            'accounttitle' => 'required|max:100',
            'group_id' => 'required|integer',
            'opening_balance' => 'nullable|numeric|min:0',
            'op_debit' => 'nullable|numeric|min:0',
            'op_credit' => 'nullable|numeric|min:0',
            'op_date' => 'nullable',
            'opening_type' => 'nullable|int|min:0|max:1',
            'currency_id' => 'nullable|int',
            'rate' => 'nullable|numeric',
            'description' => 'nullable|alpha_num'
        ]);
        $account = new Account;
        $account->fill($request->all());;
        // $account->company_id = auth()->user()->company_id;
        $account->user_id = auth()->id();
        $account->nature = 1;
        $account->currency_id = 1;
        $number = Counter::where('key', 'accounts');
        $account->accountcode = ($number->first()->perfix . $number->first()->value);
        $number->update([
            'value' => ($number->first()->value + 1)
        ]);

        $account->save();
       
        $this->save_finance_transaction($account);
        return response()->json(['saved' => true, 'model' => $account, 'accountcode' => $account]);
    }

    public function save_finance_transaction($vi)
    {


        $transaction = new Finance_transaction();
        $transactionData = [
            'vid' => $vi->id,
            'did' => '-',
            'voucher_type' => 'Opening',
            'voucher_date' => $vi->op_date,
            'voucher_number' => '-',
            'account_id' => $vi->id,

            'detail_remarks' => 'Opening Balance',
            'master_remarks' => $vi->description,
            'rate' => 1,
            'currency_id' => $vi->currency_id,
            'fc_debit' => 0,
            'fc_credit' => 0,
            'debit' => $vi->op_debit,
            'credit' => $vi->op_credit,
            'created_at' => $vi->created_at,

        ];
        $transaction->fill($transactionData);
        $transaction->save();


    }
}