<?php

namespace App\Http\Controllers;

use App\Models\CourierResponse;
use App\Models\Status;
use Illuminate\Http\Request;

class CourierResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search()
    {
        return response()->json(['data' => CourierResponse::search()]);

    }

    public function index()
    {
        return response()->json(['data' => Status::with('courier_responses')->search()]);
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
    public function show(CourierResponse $courierResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourierResponse $courierResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Status::findOrFail($id);
        $model->courier_responses()->sync(array_column($request->all(), 'id'));
        return response()->json(["saved" => true, "id" => $model->id]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourierResponse $courierResponse)
    {
        //
    }
}
