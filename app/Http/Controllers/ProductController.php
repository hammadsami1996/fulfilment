<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImg;
use App\Models\Purchase;
use App\Models\Purchase_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

// use Spatie\Backtrace\File;
// use Symfony\Component\HttpFoundation\Response;
class ProductController extends Controller
{
    protected $combinations = [];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Product::with('category', 'brand', 'product_img')->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        dd(Settings()->get('show_warranty'));
        $form = [
            "head_id" => "",
            "title" => "",
            "brand_id" => "",
            "supplier_id" => "",
            "category_id" => "",
            "sku" => "",
            "cost_price" => "",
            "selling_price" => "",
            "barcode" => "",
            "quantity" => "",
            "product_types" => 0,
            "manage_inventory" => 0,
            "weight" => 0,
        ];
        return response()->json([
            'form' => $form
        ]);
    }
    function cartesian($input) {
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

    public function store(Request $request)
    {
        $model = new Product();
        $model->fill(\request()->except('product_attribute'));
        $model->supplier_id = 1;
        $model->save();

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
//        $model = Product::with('product_img', 'brand', 'category', 'supplier')->findOrFail($id);
//        $model->Settings()->get('company_name');

        if (isset($check)) {
            $product_attributes = ProductAttribute::where('products', $id)->get();
            $Attibutes = [];
            foreach ($product_attributes as $item) {
                $grp = $item->groups;

                \DB::statement("SET SQL_MODE=''");
                $Attibutes[] = DB::select("SELECT * FROM products_attributes as pa
            LEFT JOIN products_attributes_groups as pg ON pa.groups = pg.id
            where products in (select pd.id from products as pd where pd.parent_id = $id) and pa.groups = $grp  group by pa.value ");
            }
            //            query work

            $form = Product::with('childs_Product_Image', 'test', 'attribute_sets', 'product_type', 'related_product', 'addon_product', 'categoryies', 'product_behaves', 'brand', 'warrantys', 'delivery_times', 'returns_note', 'bumps_sales', 'upsellings')->findOrFail($id);
            $details = [];
            $details = DB::select("SELECT p.*,group_concat(pa.group_title) as group_title,group_concat(pa.value_title separator '   ') as value_title,pa.products as p_id,p.sort as sort_attribute,pa.sku as sku ,pa.status as status FROM `products` p
                inner join products_attributes pa on pa.products = p.id
                where  p.parent_id = $id and p.deleted =0 and pa.variation =1 group by pa.products");
            foreach ($details as $key => $items) {
                $details[$key]->imgs = DB::select("SELECT * from products_images pi where pi.products = " . $items->id . "");
            }
//            foreach ($details as $item) {
//                $vaule_title = explode(',',$item->value_title);
//                $a= $vaule_title[0];
//                $b= $vaule_title[1];
//
//            }


        } else {
            \DB::statement("SET SQL_MODE=''");
            $a = Product::findorFail($id);
//            dd($a->parent_id);
            $id = $a->parent_id;
            $product_attributes = ProductAttribute::where('products', $id)->get();
            $Attibutes = [];
            foreach ($product_attributes as $item) {
                $grp = $item->groups;

                \DB::statement("SET SQL_MODE=''");
                $Attibutes[] = DB::select("SELECT * FROM products_attributes as pa
            LEFT JOIN products_attributes_groups as pg ON pa.groups = pg.id
            where products in (select pd.id from products as pd where pd.parent_id = $id) and pa.groups = $grp  group by pa.value ");
            }

            $form = Product::with('childs_Product_Image', 'test', 'attribute_sets', 'product_type', 'related_product', 'addon_product', 'categoryies', 'product_behaves', 'brand', 'warrantys', 'delivery_times', 'returns_note', 'bumps_sales', 'upsellings')->findOrFail($id);

            $details = [];
            $details = DB::select("SELECT p.*,group_concat(pa.group_title) as group_title,group_concat(pa.value_title separator '   ') as value_title,pa.products as p_id,p.sort as sort_attribute,pa.sku as sku ,pa.status as status FROM `products` p
    inner join products_attributes pa on pa.products = p.id
    where  p.parent_id = $id and p.deleted =0 and pa.variation =1 group by pa.products");
            foreach ($details as $key => $items) {
                $details[$key]->imgs = DB::select("SELECT * from products_images pi where pi.products = " . $items->id . "");
            }
        }

        return response()->json([
            "form" => $form,
            'Attibutes' => $Attibutes,
            'details' => $details,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = null;
        if (isset($request->categoryies)) {
            foreach ($request->categoryies as $categorie) {
                if (isset($categorie['category_id'])) {
                    $categories[] = $categorie['category_id'];
                } else {
                    $categories[] = $categorie['id'];
                }

            }
        }
        if (isset($request->addon_product)) {
            foreach ($request->addon_product as $addon_produc) {
                if (isset($addon_produc['addon_id'])) {
                    $addo_product[] = $addon_produc['addon_id'];
                } else {
//                    $categories[] = $categorie['id'];
                    $addo_product[] = $addon_produc['id'];
                }
            }
        }
        if (isset($request->related_product)) {
            foreach ($request->related_product as $related_produc) {
                if (isset($related_produc['related_product_id'])) {

                    $relado_product[] = $related_produc['related_product_id'];
                } else {

                    $relado_product[] = $related_produc['id'];
                }
            }
        }
//        $addon_pro = implode(",", $addo_product);
//        $related_pro = implode(",", $relado_product);
//        $category = implode(",", $categories);
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:255',
            'sku' => 'required|max:25',
            'model_no' => 'required|max:25',
            'barcode' => 'required|max:25',
            'cost_price' => 'required|max:25',
            'selling_price' => 'required|max:25',
            'category' => 'required|max:25',
            'brand_id' => 'required|max:25',
        ]);


        // Find the existing product by ID
        $model = Product::findOrFail($id);

        // Update the product attributes with the new data
        $model->fill($request->all());
        // Save the updated product to the database
        $model->save();
        // dd($request->all());
        // Update, create, or delete product images
        if ($request->has('product_img') && is_array($request->product_img)) {
            $existingImageIds = [];

            foreach ($request->product_img as $key => $item) {
                if (isset($item['id'])) {
                    $existingImageIds[] = (int)$item['id'];
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
                        $filename = time() . '_' . $key . '.' . $extension;
                        $file->move('uploads/product/img', $filename);
                        $data = new ProductImg();
                        $data->img = $filename;
                        $data->product_id = $model->id;
                        $data->save();
                        $existingImageIds[] = (int)$data['id'];

                    }
                }
                // If $item['img'] is text, do nothing for this item
            }
//            dd($existingImageIds);
            // Delete product images that are not in the request array
//            $existingImageIds = array_wrap($existingImageIds);
            ProductImg::where('product_id', $model->id)
                ->whereNotIn('id', $existingImageIds)
                ->delete();
            // dd($model->id);

        }
        return response()->json(["updated" => true, "id" => $model->id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Product::findOrFail($id);
        $model->deleted_by = Auth::id();

        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }

    public function product_excel(Request $request)
    {
//        dd($request);
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

    public function child_update(Request $request)
    {

//        dd(request()->all());
        $data = Product::findOrFail($request->id);
//        dd($request->id);
//        $data = Product::where('products', $request->id)->get();
//        $data = ProductAttribute::where('products', $request->id)->get();
        $data->price = $request->price;
        $data->discounted = $request->discounted;
        $data->product_qty = $request->product_qty;
        $data->model_no = $request->model_no;
        $ids = $request->id;
        DB::transaction(function () use ($ids, $data, $request) {
            $data1 = ProductAttribute::where('products', $ids)->get();
            foreach ($data1 as $item) {
                $item->sku = $request->sku ? $request->sku : 0;
                $item->status = $request->status;
                $item->save();
            }

//            Product_Image save

            if ($request->images != null) {
                $file = $request->file('images');

                foreach ($file as $img) {
                    $file = $img;
                    $destinationPath = public_path('uploads/product/product_gallery');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $imgFile = \Intervention\Image\Facades\Image::make($file->getRealPath());
                    $imgFile->resize(800, 800, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);

                    $fileNameM = 'md_' . $fileName;
                    $imgFile = \Intervention\Image\Facades\Image::make($file->getRealPath());
                    $imgFile->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileNameM);

                    $fileNameS = 'sm_' . $fileName;
                    $imgFile = \Intervention\Image\Facades\Image::make($file->getRealPath());
                    $imgFile->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileNameS);

//    Product_Image add
                    $product_image = new Product_Image();
                    $product_image->products = $request->id;
                    $product_image->images = $fileName;
                    $product_image->md_images = $fileNameM;
                    $product_image->sm_images = $fileNameS;
                    $product_image->save();

//    Product_Gallery add
                    $product_gallery = new Product_Gallery();
                    $product_gallery->create_date = now();
                    $product_gallery->added_by = Auth::user()->name;
                    $product_gallery->product_img = $fileName;
                    $product_gallery->save();

                }

//                foreach ($file as $image) {
//                    $product_image = new Product_Image();
//                    $name = str::random(10) . '.' . $image->extension();
//                    $product_image->products = $request->id;
////                    $product_image->title = $image->getClientOriginalName();
//                    $product_image->images = $name;
////                    $product_image->size = $image->getSize();
////                    $product_image->type = $image->extension();
//                    $image->move($path, $name);
//                    $product_image->save();
//                }
            }


        });
        $data->update();
        return response()
            ->json(['saved' => true]);
    }


    // public function download_images(){
    //     $datasArray = explode(',', request()->id);

    //     $data = Product::with('product_img' ,'purchases.purchase')->whereIn('id' , $datasArray)->search();

    //     $zipFileName = 'downloaded_images.zip';
    //     $zipPath = storage_path('images/') . $zipFileName;

    //     $zip = new ZipArchive;

    //     if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
    //     foreach ($data as $product) {
    //             if ($product->product_img->isNotEmpty()) {
    //                 $image = $product->product_img;
    //                 // dd($image[0]->img);
    //                 $imageName = $image[0]->img;
    //                 $imagePath = 'uploads/product/img/' . $imageName;

    //                 $imageContent = file_get_contents(public_path($imagePath));
    //                 $image = Image::make($imageContent);

    //                 $filename = time() . '_' . $imageName;


    //                 $path = 'images/';
    //                 $image->save(storage_path($path . $filename));


    //                 $zip->addFile(storage_path($path . $filename), $filename);
    //             }
    //         }
    //     }
    //     $zip->close();
    //     return response()->json(['data' =>$data]);
    //     // return response()->download($zipPath);
    // }


}
