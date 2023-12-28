<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        // dd('abcd');
        return response()->json(['data' => Customer::where('is_vender', 1)->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "name" => '',
            "company_name" => '',
            "website" => '',
            "address" => '',
            "number_1" => '',
            "number_2" => '',
            "email" => '',
            "opening_balance" => '0',
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
            'name' => 'required|max:25',
            'company_name' => 'required|max:25',
            // 'website' => 'required',
            // 'address' => 'required|max:25',
            'number_1' => 'required|max:15',
//            'number_2' => 'required',
            // 'email' => 'required|max:25',
            // 'opening_balance' => 'required|max:25',
        ]);
        $model = new Customer();
        $model->fill($request->all());
        $model->is_vender = 1;
        $model->save();
//        $model = Supplier::create($request->all());

//        $subledger = SubLedger::create(['subledger_title' =>$request->name]);
//        dd($model, $subledger);
        return response()->json(["saved" => true, "supplier_id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Customer::where('is_vender', 1)->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Customer::where('is_vender', 1)->findOrFail($id);
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
            'name' => 'required|max:25',
            'company_name' => 'required|max:25',
            // 'website' => 'required',
            // 'address' => 'required|max:25',
            'number_1' => 'required|max:15',
//            'number_2' => 'required',
            // 'email' => 'required|max:25',
            // 'opening_balance' => 'required|max:25',
        ]);
        $model = Customer::where('is_vender', 1)->findOrFail($id);
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
        $model = Customer::where('is_vender', 1)->findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
