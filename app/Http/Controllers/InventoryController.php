<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Inventory::with('product.product_img', 'wearhouse')->search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "product_id" => '',
            "warehouse_id" => '',
            "qty" => '',
            "price" => '',
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
            'product_id' => 'required',
            'warehouse_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);
        $model = new Inventory();
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Inventory::with('product', 'wearhouse')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Inventory::with('product', 'wearhouse')->findOrFail($id);
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
            'product_id' => 'required',
            'warehouse_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);
        $model = Inventory::with('product', 'wearhouse')->findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Inventory::with('product', 'wearhouse')->findOrFail($id);
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
