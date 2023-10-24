<?php

namespace App\Http\Controllers;

use App\Models\Delivery_status;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Statuslog;
use Illuminate\Support\Facades\Auth;






use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliverystatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Delivery_status::where('head' , request('head'))->where('id', '!=', request('id'))->orderBy('id')->search();
        return response()->json(['data' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.jj
     */
    public function store(Request $request  )
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery_status $Delivery_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery_status $Delivery_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery_status $Delivery_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery_status $Delivery_status)
    {
        //
    }

    public function updatestatus(Request $request  )
    {
            $data = Order::where('id' , $request->ids)->first();
            $logs = new Statuslog();
            $logs->order_id = $request->ids;
            $logs->updated_sts = $request->name;
            $logs->previous_sts = $data->status_id;
            $logs->user_id = auth()->user()->id;
            $logs->date = Carbon::now();
            $logs->save();

            $data->status_id = $request->id;
            $data->save();

            return response()->json(["saved" => true, "id" => $data->id]);
    }

    public function updatedstatus(Request $request  )
    {
            $data = Purchase::where('id' , $request->ids)->first();
            $data->status_id = $request->id;
            $data->save();
            return response()->json(["saved" => true, "id" => $data->id]);
    }
    public function searches()
    {
        $id = request('id');

         $datas = Delivery_status::where('id',$id)->value('head_id');
         $datasArray = explode(',', $datas);

        $results = Delivery_status::where('head' , request('head'))->where('id', '!=', $id)->whereIn('id' , $datasArray)->orderBy('id')
          ->search();

        return response()->json(['data' => $results]);
    }
}
