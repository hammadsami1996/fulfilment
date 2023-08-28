<?php

namespace App\Http\Controllers;

use App\Models\Delivery_status;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Statuslog;





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
        // dd(request('id'));
        // dd(request('id'));
    //    if(request('status') == 1){
        $id = request('id');
       

            // $data = Order::where('id',$id)->value('status_id');
        
        // dd($data);
        $results = Delivery_status::where('head' , request('head'))->where('id', '!=', $id)->orderBy('id')
          ->search();
        // }
        // if(request('status') == 2){
        //     $results = Delivery_status::orderBy('id')->where('id' , 3)->orwhere('id' , 5)
        //       ->search();
        //     }
        //     if(request('status') == 3){
        //         $results = Delivery_status::orderBy('id')->where('id' , 4)->orwhere('id' , 5)
        //           ->search();
        //         }
     
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
                // dd($request->all());
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
    //    dd($request->all());
            $data = Purchase::where('id' , $request->ids)->first();
            $data->status_id = $request->id;
            $data->save();
            return response()->json(["saved" => true, "id" => $data->id]);
    }
    public function searches()
    {
        // dd(request('id'));
        $id = request('id');
  

            // $data = Purchase::where('id',$id)->value('status_id');
            $datas = Delivery_status::where('id',$id)->value('head_id');
            $datasArray = explode(',', $datas);
           
        $results = Delivery_status::where('head' , request('head'))->where('id', '!=', $id)->whereIn('id' , $datasArray)->orderBy('id')
          ->search();
       
     
        return response()->json(['data' => $results]);
    }
}
