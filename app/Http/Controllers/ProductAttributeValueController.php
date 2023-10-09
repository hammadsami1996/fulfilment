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
        //
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
        $colour = json_decode(request()->test1);
        $size = json_decode(request()->test2);
        $res = $this->getCombinations($colour, $size);
        dd($res);
    }
    function getCombinations(...$arrays)
    {
        $result = [[]];

        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    public function prod_attr_value(Request $request)
    {
//        dd(request()->all());
        $request->validate([
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'value' => 'required',

        ]);
//        if(isset(request()->value)){

        $data = new ProductAttributeValue();
        $data->groups = $request->group;
        $data->title = $request->value;
        $data->add_by = now();
        $data->createdon = now();
        $data->updatedon = now();
        $data->save();
        return response()->json(['saved' => true, 'id' => $data->id]);

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
