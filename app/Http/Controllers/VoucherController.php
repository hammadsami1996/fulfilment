<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function getNumber()
    {
        $number = null;
        $voucher_type = request('voucher_type');
        $payment_type = request('payment_type');
        if ($voucher_type == 'Payment' && $payment_type == 'Cash') {
            $number = counter()->next('cash_payment_voucher');
        } else if ($voucher_type == 'Payment' && $payment_type == 'Bank') {
            $number = counter()->next('bank_payment_voucher');
        } else if ($voucher_type == 'Receipt' && $payment_type == 'Cash') {
            $number = counter()->next('cash_receipt_voucher');
        } else if ($voucher_type == 'Receipt' && $payment_type == 'Bank') {
            $number = counter()->next('bank_receipt_voucher');
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
       $request->validate([
        //    'date' => 'required|max:25',
           'voucher_type' => 'required',
           'payment_type' => 'required',
           'remarks' => 'max:100',
//           'account' => 'required'
        //    'exchange_rate' => 'required',
        //    'amount' => 'nullable|numeric|min:0',
       ]);


        $model = new Voucher();
        $model->fill($request->except('items'));
        $voucher_type = request('voucher_type');
        $payment_type = request('payment_type');
        if ($voucher_type == 'Payment' && $payment_type == 'Cash') {
            $model->number = counter()->next('cash_payment_voucher');
        } else if ($voucher_type == 'Payment' && $payment_type == 'Bank') {
            $model->number = counter()->next('bank_payment_voucher');
        } else if ($voucher_type == 'Receipt' && $payment_type == 'Cash') {
            $model->number = counter()->next('cash_receipt_voucher');
        } else if ($voucher_type == 'Receipt' && $payment_type == 'Bank') {
            $model->number = counter()->next('bank_receipt_voucher');
        }
        $model->storeHasMany([
            'items' => $request->items
        ]);
        if ($voucher_type == 'Payment' && $payment_type == 'Cash') {
            $model->number = counter()->increase('cash_payment_voucher');
        } else if ($voucher_type == 'Payment' && $payment_type == 'Bank') {
            $model->number = counter()->increase('bank_payment_voucher');
        } else if ($voucher_type == 'Receipt' && $payment_type == 'Cash') {
            $model->number = counter()->increase('cash_receipt_voucher');
        } else if ($voucher_type == 'Receipt' && $payment_type == 'Bank') {
            $model->number = counter()->increase('bank_receipt_voucher');
        }
//        // Increment the counter based on voucher type and payment type
//        if ($voucher_type == 'Payment' && $payment_type == 'Cash') {
//            counter()->increment('cash_payment_voucher');
//        } else if ($voucher_type == 'Payment' && $payment_type == 'Bank') {
//            counter()->increment('bank_payment_voucher');
//        } else if ($voucher_type == 'Receipt' && $payment_type == 'Cash') {
//            counter()->increment('cash_receipt_voucher');
//        } else if ($voucher_type == 'Receipt' && $payment_type == 'Bank') {
//            counter()->increment('bank_receipt_voucher');
//        }
        return response()->json(["saved" => true, "id" => $model->id ]);
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
