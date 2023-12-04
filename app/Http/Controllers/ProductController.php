<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImg;
use App\Models\Purchase;
use App\Models\Purchase_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

// use Spatie\Backtrace\File;
// use Symfony\Component\HttpFoundation\Response;
class ProductController extends Controller
{
    protected $combinations = [];

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return response()->json([
    //         'data' => Product::with('category', 'brand', 'product_img', 'supplier')
    //             ->when(\request()->has('title') && \request('title'), function ($q) {
    //                 $q->where('title', \request('title'));
    //             })
    //             ->when(\request()->has('sku') && \request('sku'), function ($q) {
    //                 $q->where('sku', \request('sku'));
    //             })
    //             ->when(\request()->has('cost_price') && \request('cost_price'), function ($q) {
    //                 // Apply your search logic for cost_price here
    //             })
    //             ->when(\request()->has('quantity') && \request('quantity'), function ($q) {
    //                 // Apply your search logic for quantity here
    //             })
    //             ->when(\request()->has('category_id') && \request('category_id'), function ($q) {
    //                 $q->where('category_id', \request('category_id'));
    //             })
    //             ->when(\request()->has('brand_id') && \request('brand_id'), function ($q) {
    //                 $q->where('brand_id', \request('brand_id'));
    //             })
    //             ->when(\request()->has('supplier_id') && \request('supplier_id'), function ($q) {
    //                 $q->where('supplier_id', \request('supplier_id'));
    //             })
    //             // Add more conditions as needed
    //             ->search()
    //     ]);
        
    // }
    public function index()
{
    $products = Product::with('category', 'brand', 'product_img', 'supplier')
        ->when(\request()->has('title') && \request('title'), function ($q) {
            // $q->where('title', \request('title'));
            $q->where('title', 'like', '%' . \request('title') . '%');
        })
        ->when(\request()->has('sku') && \request('sku'), function ($q) {
            // $q->where('sku', \request('sku'));
            $q->where('sku', 'like', '%' . \request('sku') . '%');
        })
        ->when(\request()->has('cost_price') && \request('cost_price'), function ($q) {
            // Apply your search logic for cost_price here
            $q->where('cost_price', 'like', '%' . \request('cost_price') . '%');
        })
        ->when(\request()->has('quantity') && \request('quantity'), function ($q) {
            // Apply your search logic for quantity here
            $q->where('quantity', 'like', '%' . \request('quantity') . '%');
        })
        ->when(\request()->has('category_id') && \request('category_id'), function ($q) {
            $q->where('category_id', \request('category_id'));
        })
        ->when(\request()->has('brand_id') && \request('brand_id'), function ($q) {
            $q->where('brand_id', \request('brand_id'));
        })
        ->when(\request()->has('supplier_id') && \request('supplier_id'), function ($q) {
            $q->where('supplier_id', \request('supplier_id'));
        })
        // Add more conditions as needed
        ->search();

    $count = $products->count();
    return response()->json([
        'data' => $products,
        'count' => $count,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "title" => "",
            "brand_id" => "",
            "supplier_id" => "",
            "category_id" => "",
            "sku" => "",
            "cost_price" => 0,
            "selling_price" => 0,
            "barcode" => "",
            "quantity" => 0,
            "product_types" => 0,
            "manage_inventory" => 0,
            "weight" => 0,
            "product_attribute" => [],
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    public function store(Request $request)
    {
        $model = new Product();
        $model->fill(\request()->except('product_attribute', 'product_img'));
        $model->supplier_id = 1;
        // $model->manage_inventry = 1;
        $model->save();
        if ($request->has('product_img')) {
            foreach ($request->product_img as $imgN) {
                $file = $imgN['img'];
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/product/img', $filename);
                $parent_img = new ProductImg();
                $parent_img->img = $filename;
                $parent_img->parent_product_id = $model->id;
                $parent_img->save();
            }
        }
        if ($request->product_types) {
            $groupsAndValues = collect($request->product_attribute);

            $combinations = $this->cartesian($groupsAndValues->pluck('values')->toArray());
            foreach ($combinations as $combination) {
                $modelChild = new Product();
                $modelChild->fill(\request()->except('product_attribute'));
                $modelChild->head_id = $model->id;
                $modelChild->supplier_id = 1;
                $modelChild->save();

                foreach ($combination as $groupValue) {
                    $NProductAttribute = new ProductAttribute();
                    $NProductAttribute->parent_product_id = $model->id;
                    $NProductAttribute->product_id = $modelChild->id;
                    $NProductAttribute->group_id = $groupValue['group_id'];
                    $NProductAttribute->value_id = $groupValue['id'];
                    $NProductAttribute->save();
                }
            }
        }
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    function cartesian($input)
    {
        $result = array();
        $arrays = array_values($input);
        $size = count($arrays);
        $indices = array_fill(0, $size, 0);

        while (true) {
            $combination = array();

            for ($i = 0; $i < $size; $i++) {
                $combination[] = $arrays[$i][$indices[$i]];
            }

            $result[] = $combination;

            for ($i = $size - 1; $i >= 0; $i--) {
                if ($indices[$i] + 1 < count($arrays[$i])) {
                    $indices[$i]++;
                    break;
                } else {
                    $indices[$i] = 0;
                    if ($i == 0) {
                        return $result;
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $model = Product::findOrFail($id);
        // return response()->json(["data" => $model]);
        $model = Product::with('category', 'brand', 'product_img', 'supplier')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $form = Product::with('product_img', 'brand', 'category', 'supplier', 'sub_products', 'attributes.group', 'attributes.value')->findOrFail($product->head_id ?? $id);
        $groupedProducts = [];
        foreach ($form->attributes as $attribute) {
            $group = $attribute->group;
            if (!isset($groupedProducts[$group->id])) {
                $groupedProducts[$group->id] = [
                    'group' => [
                        'id' => $group->id,
                        'title' => $group->title,
                        'created_at' => $group->created_at,
                        'updated_at' => $group->updated_at,
                    ],
                    'group_id' => $group->id,
                    'values' => [],
                ];
            }
            $value = $attribute->value;
            if (!in_array($value->title, array_column($groupedProducts[$group->id]['values'], 'title'))) {
                $groupedProducts[$group->id]['values'][] = [
                    'id' => $value->id,
                    'title' => $value->title,
                    'group_id' => $value->group_id,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,
                ];
            }
        }

        $groupedProducts = array_values($groupedProducts); // Reset array keys to start from 0
        $form['product_attribute'] = $groupedProducts;
        unset($form['attributes']);
        return response()->json([
            "form" => $form,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Product::findOrFail($id);
        $model->fill($request->except('product_attribute', 'product_img'));
        $model->supplier_id = 1;
        $model->save();
        if ($request->has('product_img')) {
            foreach ($request['product_img'] as $imgN) {
                if (is_file($imgN['img'])) {
                    $file = $imgN['img'];
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/product/img', $filename);
                    $parent_img = new ProductImg();
                    $parent_img->img = $filename;
                    $parent_img->parent_product_id = $model->id;
                    $parent_img->save();
                }
            }
        }
        // Handle product attributes (variations)
        if ($request->product_types) {
            $groupsAndValues = collect($request->product_attribute);

            $combinations = $this->cartesian($groupsAndValues->pluck('values')->toArray());

            foreach ($combinations as $combination) {
                // Check if a variation with the same combination already exists
                $existingVariation = $this->findExistingVariation($model, $combination);

                if (!$existingVariation) {
                    $modelChild = new Product();
                    $modelChild->fill($request->except('product_attribute'));
                    $modelChild->head_id = $model->id;
                    $modelChild->supplier_id = 1;
                    $modelChild->save();

                    foreach ($combination as $groupValue) {
                        $NProductAttribute = new ProductAttribute();
                        $NProductAttribute->parent_product_id = $model->id;
                        $NProductAttribute->product_id = $modelChild->id;
                        $NProductAttribute->group_id = $groupValue['group_id'];
                        $NProductAttribute->value_id = $groupValue['id'];
                        $NProductAttribute->save();
                    }
                }
            }
        }

        return response()->json(["updated" => true]);
    }

    private function findExistingVariation($product, $combination)
    {
        $variationAttributes = [];

        foreach ($combination as $groupValue) {
            $variationAttributes[] = [
                'group_id' => $groupValue['group_id'],
                'value_id' => $groupValue['id'],
            ];
        }
        foreach ($product->sub_products as $subProduct) {
            $existingVariationAttributes = $subProduct->sub_attributes->map(function ($attribute) {
                return [
                    'group_id' => $attribute->group_id,
                    'value_id' => $attribute->value_id,
                ];
            })->toArray();
            if ($variationAttributes == $existingVariationAttributes) {
                return $subProduct;
            }
        }

        return null;
    }

    public function product_single(Request $request)
    {
        foreach ($request->all() as $product) {
            $model = Product::findOrFail($product['id']);
            $model->quantity = $product['quantity'];
            $model->sku = $product['sku'];
            $model->barcode = $product['barcode'];
            $model->save();

            if (isset($product['product_img']) && is_file($product['product_img'])) {
                $imgN = $product['product_img'];
                $extension = $imgN->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $imgN->move('uploads/product/img', $filename);

                $parent_img = new ProductImg();
                $parent_img->img = $filename;
                $parent_img->product_id = $model->id;
                $parent_img->parent_product_id = $model->head_id;
                $parent_img->save();
            }
        }

        return response()->json(["saved" => true, "id" => $model->id]);

    }


    /**
     * Remove the specified resource from storage.
     */
//i want update function according to this functionality check

    public function destroy($id)
    {
        $model = Product::findOrFail($id);
        // Fetch associated images
//        $productImages = ProductImg::where('parent_product_id', $id)->get();
//
//        // Delete associated images from storage
//        foreach ($productImages as $image) {
//            $imagePath = public_path('uploads/product/img/' . $image->img);
//            if (file_exists($imagePath)) {
//                unlink($imagePath); // Delete the file
//            }
//            $image->delete(); // Delete the image record from the database
//        }
        if (!$model->head_id) {
            ProductAttribute::where('parent_product_id', $id)->delete();
            Product::where('head_id', $id)->delete();
            $model->deleted_by = Auth::id();
            $model->save();
            $model->delete();
        } else {
            ProductAttribute::where('product_id', $id)->delete();
            $model->deleted_by = Auth::id();
            $model->save();
            $model->delete();
        }

        return response()->json(["deleted" => true]);
    }
    public function updateCost(Request $request, $itemId)
    {
        // Find the product by ID
        // dd("cost");
        $cost = $request->cost_price;
        $product = Product::findOrFail($itemId);
        $product->cost_price = $cost;
      
        $product->save();
        return response()->json(['message' => 'Cost price updated successfully']);
    }
    public function updateSelling(Request $request, $itemId)
    {
        // Find the product by ID
        $selling = $request->selling_price;
        $product = Product::findOrFail($itemId);
        $product->selling_price = $selling;
        $product->save();
        // You can return a response if needed
        return response()->json(['message' => 'selling price updated successfully']);
    }
    public function updateQuantity(Request $request, $itemId)
    {
        // Find the product by ID
        $quantity = $request->quantity;
        $product = Product::findOrFail($itemId);
        $product->quantity = $quantity;
        $product->save();
        // You can return a response if needed
        return response()->json(['message' => 'quantity updated successfully']);
    }

    public function bulk_price(Request $request){
  
        $selectedItems = $request['selectedItems']; 
      
        $operation = $request['operation']; 
        $unit = $request['unit']; 
        $costPercentage = $request['costPrice']; 
        $sellingpercentage = $request['sellingPrice']; 

    if ($unit == 'rupees') {
        foreach ($selectedItems as $itemId) {
            $product = Product::findOrFail($itemId);
    
            if ($operation == 'increase') {
                $product->cost_price += $costPercentage;
                $product->selling_price += $sellingpercentage;
            } elseif ($operation == 'decrease') {
                // Ensure prices don't go below zero
                $product->cost_price = max(0, $product->cost_price - $costPercentage);
                $product->selling_price = max(0, $product->selling_price - $sellingpercentage);
            }
    
            $product->save();
            return response()->json(['message' => 'Prices update successfully']);
        }
    }
    elseif ($unit == 'percent') {
        if ($operation == 'increase') {
            $products = Product::whereIn('id', $selectedItems)->get();
    
            foreach ($products as $product) {
                // Extract the cost_price and selling_price for each product
                $costPrice = $product->cost_price;
                $sellingPrice = $product->selling_price;
    
                // Calculate new cost and selling prices based on the percentage for increase
                $newCostPrice = $costPrice + ($costPrice * ( $costPercentage / 100));
                $newSellingPrice = $sellingPrice + ($sellingPrice * ($sellingpercentage  / 100));
    
              
                $product->cost_price = $newCostPrice;
                $product->selling_price = $newSellingPrice;
                $product->save();

            }
    
            // Now $products are updated with increased prices
            return response()->json(['message' => 'Prices increased successfully']);
        } elseif ($operation == 'decrease') {
            $products = Product::whereIn('id', $selectedItems)->get();
    
            foreach ($products as $product) {
                // Extract the cost_price and selling_price for each product
                $costPrice = $product->cost_price;
                $sellingPrice = $product->selling_price;
    
                // Calculate new cost and selling prices based on the percentage for decrease
                $newCostPrice = $costPrice - ($costPrice * ($costPercentage / 100));
                $newSellingPrice = $sellingPrice - ($sellingPrice * ($sellingpercentage / 100));
    
                // Ensure prices don't go below zero
                $newCostPrice = max(0, $newCostPrice);
                $newSellingPrice = max(0, $newSellingPrice);
    
                $product->cost_price = $newCostPrice;
                $product->selling_price = $newSellingPrice;
                $product->save();
            }
            return response()->json(['message' => 'Prices decrease successfully']);
        }
    }
}
   public function bulk_delete(Request $request){
       $selectedItems = $request['selectedItems']; 
    foreach ($selectedItems as $itemId) {
        $product = Product::findOrFail($itemId);
        $product->deleted_by = Auth::id();
        $product->save();
        $product->delete();
    }    
    return response()->json(['message' => 'Prices Delete successfully']);

    }
    public function bulk_manage(Request $request){
        $id = $request->id;
        $item = Product::findOrFail($id);
        $item->manage_inventory = $request->data;
        $item->save();
    
        return response()->json(['message' => 'Manage Inventory updated successfully']);


    }

    public function destroy_product_image($id)
    {
        $model = ProductImg::findOrFail($id);
        $imagePath = public_path('uploads/product/img/' . $model->img);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the file
        }
        $model->delete(); // Delete the image record from the database
        return response()->json(["deleted" => true]);
    }

    public function product_excel(Request $request)
    {
        $data = Product::get();
        return Excel::download(new \App\Exports\product_excel($data), 'Product.xls');
    }


    public function download_images()
    {
        $datasArray = explode(',', request()->id);
        $data = Product::with('product_img')->whereIn('id', $datasArray)->search();

        foreach ($data as $key => $result) {
            $resultArray = get_object_vars($result);
            $dd = Purchase_item::with('purchase.supplier')->where('product_id', $result['id'])->orderBy('id', 'desc')->limit(3)->get();
// dd($dd);
            // $dd = DB::select("select business_name,c.id,username,email,mobile_no,n.min from contractors c left join no_of_operatives n on c.no_operative = n.id ");
            $collectdd = collect($dd);
            // $resultArray['purchases'] = $collectdd->toArray();
            $data[$key]['purchases'] = ((object)$collectdd)->toArray();
        }

        $vendor = Purchase_item::whereIn('product_id', $datasArray)->pluck('purchase_id')->unique();
        $vendors = Purchase::with('supplier')->whereIn('id', $vendor)->get();
        // $data->toArray();
        // dd($data);
        // $array = get_object_vars($data);

        // dd($mergedArray);

        // $zipFileName = 'downloaded_images.zip';
        // $zipPath = storage_path('images/') . $zipFileName;

        // $zip = new ZipArchive;

        // if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
        //     foreach ($data as $product) {
        //         if ($product->product_img->isNotEmpty()) {
        //             $image = $product->product_img;
        //             $imageName = $image[0]->img;
        //             $imagePath = 'uploads/product/img/' . $imageName;

        //             $imageContent = file_get_contents(public_path($imagePath));
        //             $image = Image::make($imageContent);

        //             $filename = time() . '_' . $imageName;

        //             $path = 'images/';
        //             $image->save(storage_path($path . $filename));

        //             $zip->addFile(storage_path($path . $filename), $filename);
        //         }
        //     }
        //     $zip->close();
        // }

        // Return the path of the generated ZIP file
        return response()->json(['data' => $data, 'id' => $vendors]);
    }
}
