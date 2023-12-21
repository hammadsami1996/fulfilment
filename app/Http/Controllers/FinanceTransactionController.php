<?php

namespace App\Http\Controllers;

use App\Models\Finance_transaction;
use App\Models\Finance_transaction_master;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class FinanceTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Finance_transaction_master::with(['items.account','items.subledger'])->search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "voucher_date" => '',
            "voucher_number" => null,
            "detail_remarks" => '',
            "master_remarks" => '',
            "account_id" => null,
            "subledger_id" => null,
            "debit" => 0,
            "credit" => 0,
           
        ];
        return response()->json(['form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $request->validate([
            // 'account_id' => 'required|max:15',
            // 'po_date' => 'required',
            // 'due_date' => 'required',
            'items' => 'required|array|min:1',
            'items.*.account' => 'required',
        ]);
      
        $model = new Finance_transaction_master();
        $model->voucher_date = $request->voucher_date;
        $model->detail_remarks = $request->detail_remarks;
        $model->voucher_type = "sale";
     
        $model->voucher_number = 'JV-' . mt_rand(100000, 999999);
        $model->storeHasMany([
            'items' => $request->items
        ]);
        return response()->json(["saved" => true, "id" => $model->id ]);
        
       

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model =  Finance_transaction_master::with(['items.account','items.subledger'])->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {    
        $model = Finance_transaction_master::with([ 'items.account','items.subledger'])->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Finance_transaction_master::findOrFail($id);
        $model->fill($request->except('items'));
        $model->updateHasMany([
            'items' => $request->items
        ]);

        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Finance_transaction_master::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
