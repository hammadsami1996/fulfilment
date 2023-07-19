<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Purchase::with('supplier')->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "supplier_id" => '',
            "po_number" => '',
            "po_reference_number" => '',
            "po_date" => '',
            "due_date" => '',
            "discount" => '',
            "sku" => '',
            "name" => '',
            "qty" => '',
            "purchasing_price" => '',
            "tax" => '',
            "sub_total" => '',
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    /**
     * Purchase a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
//            'po_number' => 'required',
            'po_reference_number' => 'required',
            'po_date' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'sku' => 'required',
//            'name' => 'required',
//            'qty' => 'required',
//            'purchasing_price' => 'required',
//            'tax' => 'required',
//            'sub_total' => 'required',
        ]);
        $model = new Purchase();
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Purchase::with('supplier')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Purchase::with('supplier')->findOrFail($id);
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
            'supplier_id' => 'required',
//            'po_number' => 'required',
            'po_reference_number' => 'required',
            'po_date' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'sku' => 'required',
//            'name' => 'required',
//            'qty' => 'required',
//            'purchasing_price' => 'required',
//            'tax' => 'required',
//            'sub_total' => 'required',
        ]);
        $model = Purchase::with('supplier')->findOrFail($id);
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
        $model = Purchase::with('supplier')->findOrFail($id);
//        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
