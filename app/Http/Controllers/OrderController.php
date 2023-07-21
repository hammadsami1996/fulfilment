<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Order::with('customer')->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "store" => '',
            "order_date" => '',
            "customer_id" => '',
            "city" => '',
            "total" => '',
            "tax" => '',
            "balance" => '',
            "courier" => '',
            "payment_status" => '',
            "location" => '',
            "sales_rep" => '',
            "selling_price" => '',


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
//            'store' => 'required',
            'order_date' => 'required',
            'customer_id' => 'required',
//            'city' => 'required',
//            'total' => 'required',
//            'tax' => 'required',
//            'balance' => 'required',
//            'courier' => 'required',
//            'payment_status' => 'required',
//            'location' => 'required',
//            'sales_rep' => 'required',
            'selling_price' => 'required',
        ]);
        $model = new Order();
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Order::with('customer')->findOrFail($id);
        return response()->json(["data" => $model]);    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Order::with('customer')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
//            'store' => 'required',
            'order_date' => 'required',
            'customer_id' => 'required',
//            'city' => 'required',
//            'total' => 'required',
//            'tax' => 'required',
//            'balance' => 'required',
//            'courier' => 'required',
//            'payment_status' => 'required',
//            'location' => 'required',
//            'sales_rep' => 'required',
            'selling_price' => 'required',
        ]);
        $model = Order::with('customer')->findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Order::with('customer')->findOrFail($id);
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
