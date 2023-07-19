<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Customer::with('type')->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "name" => '',
            "email" => '',
            "phone" => '',
            "cateogory" => '',
            "balance" => '',
            "type_id" => '',
            "discount" => '',
            "address" => '',
            "country_id" => '',
            "state_id" => '',
            "city_id" => '',
            "number" => '',
            "cnic" => '',
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
//            'cateogory' => 'required',
            'balance' => 'required',
            'type_id' => 'required',
//            'discount' => 'required',
//            'address' => 'required',
//            'country_id' => 'required',
//            'state_id' => 'required',
//            'city_id' => 'required',
//            'number' => 'required',
            'cnic' => 'required',
        ]);
        $model = new Customer();
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Customer::with('type')->findOrFail($id);
        return response()->json(["data" => $model]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Customer::with('type')->findOrFail($id);
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
//            'cateogory' => 'required',
            'balance' => 'required',
            'type_id' => 'required',
//            'discount' => 'required',
//            'address' => 'required',
//            'country_id' => 'required',
//            'state_id' => 'required',
//            'city_id' => 'required',
//            'number' => 'required',
            'cnic' => 'required',
        ]);
        $model = Customer::with('type')->findOrFail($id);
        $model->fill($request->all());
        //        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Customer::with('type')->findOrFail($id);
        //        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
