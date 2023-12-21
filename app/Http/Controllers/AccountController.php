<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Account_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Account::with('group')->search()]);

    }

    public function create()
    {
        $form = [
            "accounttitle" => '',
            "shortname" => '',
            "active" => '',
            "description" => '',
           
        ];
        return response()->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
       $request->validate([
           // 'accountcode' => 'required|max:100',
           'accounttitle' => 'required|max:100',
        //    'group_id' => 'required|integer',
        //    'opening_balance' => 'nullable|numeric|min:0',
        //    'op_debit' => 'nullable|numeric|min:0',
        //    'op_credit' => 'nullable|numeric|min:0',
        //    'op_date' => 'nullable',
        //    'opening_type' => 'nullable|int|min:0|max:1',
        //    'currency_id' => 'nullable|int',
        //    'rate' => 'nullable|numeric',
        //    'description' => 'nullable|alpha_num'
       ]);
        $model = new Account;
        $model->fill($request->all());
        $model->accountcode = (Account::select('accountcode')->where('group_id', $request->group_id)->orderBy('accountcode', 'desc')->value('accountcode') != null ? Account::select('accountcode')->where('group_id', $request->group_id)->orderBy('accountcode', 'desc')->value('accountcode') + 1 : Account_group::findOrfail($request->group_id)->code . '0001');
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

//    public function save_finance_transaction($vi)
//    {
//
//
//        $transaction = new Finance_transaction();
//        $transactionData = [
//            'vid' => $vi->id,
//            'did' => '-',
//            'voucher_type' => 'Opening',
//            'voucher_date' => $vi->op_date,
//            'voucher_number' => '-',
//            'account_id' => $vi->id,
//
//            'detail_remarks' => 'Opening Balance',
//            'master_remarks' => $vi->description,
//            'rate' => 1,
//            'currency_id' => $vi->currency_id,
//            'fc_debit' => 0,
//            'fc_credit' => 0,
//            'debit' => $vi->op_debit,
//            'credit' => $vi->op_credit,
//            'created_at' => $vi->created_at,
//
//        ];
//        $transaction->fill($transactionData);
//        $transaction->save();
//
//
//    }

    public function show($id)
    {
        $model = Account::with('group')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    public function edit($id)
    {
        $model = Account::with('group')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
//        $request->validate([
//            'title' => 'required|max:25',
//        ]);
        $model = Account::with('group')->findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function destroy($id)
    {
        $account = Account::with('group')->findOrFail($id);
        $account->deleted_by = Auth::id();
        $account->save();
        $account->delete();
        return response()
            ->json(['deleted' => true]);
    }
}
