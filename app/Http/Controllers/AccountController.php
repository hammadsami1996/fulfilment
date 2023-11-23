<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Account::search()]);

    }

    public function create()
    {
        $form = [
            "accounttitle" => '',
            "shortname" => '',
            "active" => '',
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
//        $request->validate([
//            // 'accountcode' => 'required|max:100',
//            'accounttitle' => 'required|max:100',
//            'group_id' => 'required|integer',
//            'opening_balance' => 'nullable|numeric|min:0',
//            'op_debit' => 'nullable|numeric|min:0',
//            'op_credit' => 'nullable|numeric|min:0',
//            'op_date' => 'nullable',
//            'opening_type' => 'nullable|int|min:0|max:1',
//            'currency_id' => 'nullable|int',
//            'rate' => 'nullable|numeric',
//            'description' => 'nullable|alpha_num'
//        ]);
        $model = new Account;
        $model->fill($request->all());
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
        $model = Account::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    public function edit($id)
    {
        $model = Account::findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }
    public function update(Request $request, $id)
    {
//        $request->validate([
//            'title' => 'required|max:25',
//        ]);
        $model = Account::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

//    public function update(Request $request, $id)
//    {
//        //return $request;
//        $model = Account::findOrFail($id);
//        $request->validate([
//            'accountcode' => 'required|max:100',
//            'accounttitle' => 'required|max:100',
//            'group_id' => 'required|integer',
//            'opening_balance' => 'nullable|numeric|min:0',
//            'op_debit' => 'nullable|numeric|min:0',
//            'op_credit' => 'nullable|numeric|min:0',
//            'op_date' => 'nullable',
//            'op_debit' => 'nullable|numeric|min:0',
//            'op_credit' => 'nullable|numeric|min:0',
//            // 'opening_type' => 'required|int|min:0|max:1'
//            'opening_type' => 'nullable|int|min:0|max:1',
//
//            //'currency_id' => 'required|int'
//        ]);
//
//        $model->user_id = auth()->id();
//        $model->fill($request->all());
//        $model->save();
//        $financeData = Finance_transaction::where('vid', $model->id)->where('voucher_type', 'Opening Balance')->delete();
//        $this->save_finance_transaction($model);
//        return response()->json([
//            'saved' => true,
//            'model' => $model,
//            'id' => $model->id
//        ]);
//    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->deleted_by = Auth::id();
        $account->save();
        $account->delete();
        return response()
            ->json(['deleted' => true]);
    }
}
