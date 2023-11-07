<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class DashboardCountroller extends Controller
{
    public function getorders()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_orders = Order::count();
        $total_order_amount = Order::sum('net_total');
        $total_order_cancel = Status::count();
//        $status_count = Status::whereIn('status', ['Cancelled', 'Confirmed'])->count();

        return response()->json(['total_orders' => $total_orders, 'total_orders_amount' => $total_order_amount,
            'total_order_cancel' => $total_order_cancel,
//            'status_count' => $status_count
        ]);
//        dd('abc');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
