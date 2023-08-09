<?php

namespace App\Http\Controllers;

use App\Models\ProdductImg;
use App\Models\Product;
use App\Models\ProductImg;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Product::with('category', 'brand')->search()]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "title" => '',
            "description" => '',
            "product_sku" => '',
            "model_no" => '',
            "barcode" => '',
            "manage_inventory" => '',
            "product_qty" => '',
            "product_types" => '',
            "cost_price" => '',
            "selling_price" => '',
            "start_date" => '',
            "end_date" => '',
            "product_category" => '',
            "brand_id" => '',
            "head_id" => '',
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
        $model = new Product();
        $model->fill($request->all());
//        dd($model);
        $model->save();

        foreach ($request->product_img as $key => $item) {
            $file = $item['img'];
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/img', $filename);
            $data = new ProductImg();
            $data->img = $filename;
            $data->product_id = $model->id;
            $data->save();
        }

        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Product::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Product::with('product_img', 'brand', 'category')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the existing product by ID
        $model = Product::findOrFail($id);

        // Update the product attributes with the new data
        $model->fill($request->all());
        // Save the updated product to the database
        $model->save();

        // Update, create, or delete product images
        if ($request->has('product_img') && is_array($request->product_img)) {
            $existingImageIds = [];

            foreach ($request->product_img as $key => $item) {
                if (isset($item['id'])) {
                    $existingImageIds =  (int) $item['id'];
                }
                if (isset($item['img']) && $item['img'] instanceof \Illuminate\Http\UploadedFile) {
                    // If $item['img'] is a file, check if $item has 'id'
                    if (isset($item['id'])) {
                        // If 'id' is set, update the existing image
                        $productImg = ProductImg::findOrFail($item['id']);
                        $file = $item['img'];
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/product/img', $filename);
                        $productImg->img = $filename;
                        $productImg->save();
                    } else {
                        // If 'id' is not set, create a new entry for the image
                        $file = $item['img'];
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/product/img', $filename);
                        $data = new ProductImg();
                        $data->img = $filename;
                        $data->product_id = $model->id;
                        $data->save();
                    }
                }
                // If $item['img'] is text, do nothing for this item
            }
//            dd($existingImageIds);
            // Delete product images that are not in the request array
            $existingImageIds = array_wrap($existingImageIds);
            ProductImg::where('product_id', $model->id)
                ->whereNotIn('id', $existingImageIds)
                ->delete();

        }
        return response()->json(["updated" => true, "id" => $model->id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Product::findOrFail($id);
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
