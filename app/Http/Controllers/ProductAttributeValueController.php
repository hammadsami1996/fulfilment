<?php

namespace App\Http\Controllers;

use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;

class ProductAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => ProductAttributeValue::when(\request()->has('group_id'), function ($q) {
            $q->where('group_id', \request('group_id'));
        })->search()]);
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
    public function show(ProductAttributeValue $productAttributeValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttributeValue $productAttributeValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAttributeValue $productAttributeValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttributeValue $productAttributeValue)
    {
        //
    }
}
