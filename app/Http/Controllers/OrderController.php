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
        return response()->json(['data' => Order::with('customer',  'items.product', 'stores')->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "store_id" => '',
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
            "external_order_no" => '',
            "tracking_id" => '',
            "product_id" => '',
            "subTotal" => '',
            "discount" => '',
            'discount_percent' => 0,
            'selling_price' => 0,


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
//        dd($request->all());
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
//            'selling_price' => 'required',
            'external_order_no' => 'required',
            'tracking_id' => 'required',
        ]);
        $model = new Order();
        $model->fill($request->except('items'));
        $model->storeHasMany([
            'items' => $request->items
        ]);
//        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Order::with('customer',  'items.product', 'stores')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Order::with('customer', 'items.product', 'stores')->findOrFail($id);
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
        $model = Order::findOrFail($id);
        $model->fill($request->except('items'));
        $model->updateHasMany([
            'items' => $request->items
        ]);
//        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Order::with('customer', 'items', 'stores')->findOrFail($id);
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
