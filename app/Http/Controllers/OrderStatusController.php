<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index() {
        $status = Status::where('head','order')->search();
        return response()->json(['data' => $status]);
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
        return response()->json(['message' => 'order status updated successfully']);
    }
}
