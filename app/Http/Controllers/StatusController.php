<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Status;
use App\Models\Statuslog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Status::where('head', request('head'))->where('id', '!=', request('id'))->orderBy('id')->search();
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        //
    }

    public function updatestatus(Request $request)
    {
        $data = Order::where('id', $request->ids)->first();
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

    public function updated_status(Request $request)
    {
        $data = Purchase::where('id', $request->ids)->first();
        $data->status_id = $request->id;
        $data->save();
        return response()->json(["saved" => true, "id" => $data->id]);
    }

    public function searches()
    {
        $id = request('id');
        $head = request('head');

        $headId = Status::where('id', $id)->value('head_id');
        $headIdArray = explode(',', $headId);

        $results = Status::where('head', $head)
            ->where('id', '!=', $id)
            ->whereIn('id', $headIdArray)
            ->orderBy('id')
            ->get();  // Assuming you want to fetch results, not using a non-standard 'search' method

        return response()->json(['data' => $results]);
    }
}