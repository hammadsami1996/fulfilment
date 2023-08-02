<?php

namespace App\Http\Controllers;

use App\Models\Delivery_status;
use App\Models\Order;



use App\Models\Type;

use Illuminate\Http\Request;

class DeliverystatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(request('status'));
       if(request('status') == 1){
        $results = Delivery_status::orderBy('id')->where('id' , 2)->orwhere('id' , 5)
          ->search();
        }
        if(request('status') == 2){
            $results = Delivery_status::orderBy('id')->where('id' , 3)->orwhere('id' , 5)
              ->search();
            }
            if(request('status') == 3){
                $results = Delivery_status::orderBy('id')->where('id' , 4)->orwhere('id' , 5)
                  ->search();
                }
     
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
    //    dd($request->all());
            $data = Order::where('id' , $request->ids)->get();
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
    //    dd($request->all());
            $data = Order::where('id' , $request->ids)->first();
            $data->status_id = $request->id;
            $data->save();
            return response()->json(["saved" => true, "id" => $data->id]);
    }
}
