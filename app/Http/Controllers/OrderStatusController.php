<?php

namespace App\Http\Controllers;

use App\Models\Finance_transaction;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index() {
        $status = Status::where('head','order')->search();
        return response()->json(['data' => $status]);
    }

    public function edit(Request $request){
        $id = $request->id;
        $model = Status::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    public function update(Request $request){
        // dd($request->all());
        $id = $request->id;
        $name = $request->name;
        $message = $request->message;
        $stock_qty = $request->stock_qty;
        $sort = $request->sort;

        $model = Status::findOrFail($id);
        $model->name = $name;
        $model->message = $message;
        $model->stock_qty = $stock_qty;
        $model->sort = $sort;
        $model->save();
        return response()->json(['message'=>'update successfully']);

    }
    public function bulk_order_email(Request $request) {
        $id = $request->id;
        $item = Status::findOrFail($id);
        $item->email = $request->data;
        $item->save();
        return response()->json(['message' => 'order status updated successfully']);
    }
    public function bulk_order_sms(Request $request) {
        $id = $request->id;
        $item = Status::findOrFail($id);
        $item->sms = $request->data;
        $item->save();
        return response()->json(['message' => 'order status updated successfully']);
    }
    public function bulk_order_active(Request $request) {
        $id = $request->id;
        $item = Status::findOrFail($id);
        $item->active = $request->data;
        $item->save();
        return response()->json(['message' => 'order status updated successfully']);
    }
    public function bulk_order_sale(Request $request) {
        $id = $request->id;
        $item = Status::findOrFail($id);
        $item->sales_on = $request->data;
        $item->save();
        Status::where('id', '<>', $id)->update(['sales_on' => 0]);
        // $orders = Order::where('status_id', $id)->get();

        //     foreach ($orders as $order) {
        //         $finanace = new Finance_transaction();
        //         $finanace->voucher_date = today();  
        //         $finanace->reference_no = $order->id;
        //         $finanace->voucher_type = "sale";
        //         $finanace->debit = $order->total;
        //         $finanace->credit = $order->total;

        //         $finanace->save();
        //     }
     
        return response()->json(['message' => 'order status updated successfully']);
    }
}
