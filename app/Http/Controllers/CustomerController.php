<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use App\Models\Courier;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $customer = Customer::with(// 'type',
                 'category', 's_city','b_city','account',
                //   's_country',
                  'b_country')
        ->when(\request()->has('searchTerm') && \request('searchTerm'), function ($q) {
            // $q->where('title', \request('title'));
            $q->where('name', 'like', '%' . \request('searchTerm') . '%');
        })->where('is_vender','!=',1)->search();
        return response()->json([
            'data' => $customer,
        ]);
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
            "category_id" => '',
            "account_id" => '',
            // "balance" => '',
            // "type_id" => '',
//            "address" => '',
            "b_country_id" => '',
            // "s_country_id" => '',
            "state_id" => '',
            "b_city_id" => '',
            "s_city_id" => '',
            'is_vender' => 0,
            'is_customer' => 0,
            'is_courier' => 0,
//            "number" => '',
            "cnic" => '',
            "b_name" => '',
            "b_phone" => '',
            "b_address_1" => '',
            "s_name" => '',
            "s_phone" => '',
            "s_address_1" => '',
            // "date" => '',
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
//            'balance' => 'required',
//            'type_id' => 'required',
//            'discount' => 'required',
//            'address' => 'required',
//            'country_id' => 'required',
//            'state_id' => 'required',
//            'city_id' => 'required',
//            'number' => 'required',
        //    'cnic' => 'required',
        ]);
        $model = new Customer();
        $model->fill($request->all());
        $model->is_customer = 1;
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Customer::with( 'category','s_city','b_city', 's_country','b_country','account')->findOrFail($id);
        return response()->json(["data" => $model]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Customer::with(
             'category','s_city','b_city','account',
              's_country',
              'b_country')->findOrFail($id);
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
            // 'name' => 'required',
            // 'email' => 'required',
            // 'phone' => 'required',
//            'cateogory' => 'required',
//            'balance' => 'required',
//            'type_id' => 'required',
//            'discount' => 'required',
//            'address' => 'required',
//            'country_id' => 'required',
//            'state_id' => 'required',
//            'city_id' => 'required',
//            'number' => 'required',
            // 'cnic' => 'required',
        ]);
        $model = Customer::with(
            // 'type',
             'category', 's_city','b_city','account',
            //   's_country',
              'b_country')->findOrFail($id);
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
        $model = Customer::with(
            // 'type',
             'category', 's_city','b_city','account',
            //   's_country',
              'b_country')->findOrFail($id);
               $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}

