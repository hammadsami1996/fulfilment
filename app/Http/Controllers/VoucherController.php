<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function getNumber()
    {
        $number = '';
        $voucher_type = request('voucher_type_id');
        if (request('transaction_type_id')) {
            $transaction_type = request('transaction_type_id');
        }
        if ($voucher_type == 1) {
            $number = counter()->next('journal_voucher');
        } elseif ($voucher_type == 2) {
            if ($transaction_type == 1)
                $number = counter()->next('cash_payment_voucher');
            else
                $number = counter()->next('bank_payment_voucher');
        } elseif ($voucher_type == 3) {
            if ($transaction_type == 1) {
                $number = counter()->next('cash_receipt_voucher');
            } else {
                $number = counter()->next('bank_receipt_voucher');
            }
        }
        return response()->json(['results' => $number]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Voucher::with(['items.account'])->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "date" => '',
            "voucher_type" => '',
            "payment_type" => '',
            "remarks" => '',
            "number" => '',
            'account_id' => null,
            'account' => null,
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'date' => 'required|max:25',
//            'voucher_type' => 'required',
//            'payment_type' => 'required',
//            'currency' => 'required',
//            'exchange_rate' => 'required',
//            'amount' => 'nullable|numeric|min:0',
//        ]);
        $model = new Voucher();
        $model->fill($request->except('items'));

//        $voucherType = '';
//        $voucherType('bank_payment_voucher','cash_payment_voucher','bank_receipt_voucher','cash_receipt_voucher');
//        foreach ($voucherType as $type){
//            $number = Counter::where('key', $type);
//            if ($type === 'bank_payment_voucher'){
//                $model->bank_payment_voucher = $number->first()->prefix . $number->first()->value;
//            }
//            elseif ($type === 'cash_payment_voucher'){
//                $model->cash_payment_voucher = $number->first()->prefix . $number->first()->value;
//            }
//            elseif ($type === 'bank_receipt_voucher'){
//                $model->bank_receipt_voucher = $number->first()->prefix . $number->first()->value;
//            }elseif ($type === 'cash_receipt_voucher'){
//                $model->cash_receipt_voucher = $number->first()->prefix . $number->first()->value;
//            }
//            $number->increment('value');
//        }
//        $number = Counter::where('key', 'bank_payment_voucher');
//        $model->number = ($number->first()->prefix . $number->first()->value);

        $model->storeHasMany([
            'items' => $request->items
        ]);
        return response()->json(["saved" => true, "id" => $model->id, 'results' => $number]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Voucher::with(['items.account'])->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Voucher::with([ 'items.account'])->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
//        $request->validate([
//            'date' => 'required|max:25',
//            'voucher_type' => 'required',
//            'payment_type' => 'required',
//            'currency' => 'required',
//            'exchange_rate' => 'required',
//        ]);
        $model = Voucher::findOrFail($id);
        $model->fill($request->except('items'));
        $model->updateHasMany([
            'items' => $request->items
        ]);

        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Voucher::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
