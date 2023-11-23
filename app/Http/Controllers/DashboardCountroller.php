<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderViews;
use App\Models\Status;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DashboardCountroller extends Controller
{
    public function getorders()
    {

    }
    /**
     * Display a listing of the resource.
     */


public function index(Request $request)
{
    $selectedPeriod = $request->input('period', 'daily'); 

         $packable_Orders_Query = OrderViews::where('packability', 'packable');
        $unpackable_Orders_Query = OrderViews::where('packability', 'unpackable');
 
   
    $now = Carbon::now();
    switch ($selectedPeriod) {
        case 'daily':
            $startDate = $now->toDateString();
            $endDate = $now->toDateString();
            $packable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
             $unpackable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
             break;
        case 'weekly':
            $startDate = $now->startOfWeek()->toDateString();
            $endDate = $now->endOfWeek()->toDateString();
            $packable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
            $unpackable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
            break;
        case 'monthly':
            $startDate = $now->startOfMonth()->toDateString();
            $endDate = $now->endOfMonth()->toDateString();
            $packable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
            $unpackable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
            break;
        case 'yearly':
            $startDate = $now->startOfYear()->toDateString();
            $endDate = $now->endOfYear()->toDateString();
            $packable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
            $unpackable_Orders_Query->whereBetween('order_date', [$startDate, $endDate]);
            break;
        default:
            $startDate = $now->toDateString();
            $endDate = $now->toDateString();
    }

    $packable_Orders_Count = $packable_Orders_Query->count();
     $unpackable_Orders_Count = $unpackable_Orders_Query->count();
    
    $total_orders = OrderViews::whereBetween('order_date', [$startDate, $endDate])->count();
    $total_order_amount = OrderViews::whereBetween('order_date', [$startDate, $endDate])->sum('net_total');
    $total_order_cancel = OrderViews::where('status_id', 5)->whereBetween('order_date', [$startDate, $endDate])->count();
    $total_order_return_received = OrderViews::where('status_id', 15)->whereBetween('order_date', [$startDate, $endDate])->count();
    $total_order_onHold = OrderViews::where('status_id', 6)->whereBetween('order_date', [$startDate, $endDate])->count();
    $total_order_confirmed = OrderViews::where('status_id', 2)->whereBetween('order_date', [$startDate, $endDate])->count();
    

    return response()->json([
        'total_orders' => $total_orders,
        'total_orders_amount' => $total_order_amount,
        'total_order_cancel' => $total_order_cancel,
        'total_order_return_received' => $total_order_return_received,
        'total_order_onHold' => $total_order_onHold,
        'total_order_confirmed' => $total_order_confirmed,
        'packable_Orders_Count' => $packable_Orders_Count,
         'unpackable_Orders_Count' => $unpackable_Orders_Count,
    ]);
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
