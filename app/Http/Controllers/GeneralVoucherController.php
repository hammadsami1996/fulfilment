<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Counter;
use App\Models\General_Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => General_Voucher::search()]);

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
            "currency" => '',
            "exchange_rate" => '',
            "remarks" => '',
            "number" => '',
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
//        ]);
        $model = new General_Voucher();
        $model->fill($request->all());
        $voucherType = '';
        $voucherType('bank_payment_voucher','cash_payment_voucher','bank_receipt_voucher','cash_receipt_voucher');
        foreach ($voucherType as $type){
            $number = Counter::where('key', $type);
            if ($type === 'bank_payment_voucher'){
                $model->bank_payment_voucher = $number->first()->prefix . $number->first()->value;
            }
            elseif ($type === 'cash_payment_voucher'){
                $model->cash_payment_voucher = $number->first()->prefix . $number->first()->value;
            }
            elseif ($type === 'bank_receipt_voucher'){
                $model->bank_receipt_voucher = $number->first()->prefix . $number->first()->value;
            }elseif ($type === 'cash_receipt_voucher'){
                $model->cash_receipt_voucher = $number->first()->prefix . $number->first()->value;
            }
            $number->increment('value');
        }
//        $number = Counter::where('key', 'bank_payment_voucher');
//        $model->number = ($number->first()->prefix . $number->first()->value);

        $model->save();
        return response()->json(["saved" => true, "id" => $model->id, 'results' => $number]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = General_Voucher::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = General_Voucher::findOrFail($id);
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
        $model = General_Voucher::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = General_Voucher::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
