<?php

namespace App\Http\Controllers;

use App\Models\Addon_master;
use App\Models\Category_master;
use App\Models\ProdductImg;
use App\Models\Product;
use App\Models\Product_Gallery;
use App\Models\Product_Image;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductImg;
use App\Models\Purchase;
use App\Models\Purchase_item;
use App\Models\Related_product_master;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Response;

// use Spatie\Backtrace\File;
// use Symfony\Component\HttpFoundation\Response;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Product::with('category', 'brand', 'product_img', 'product_type')->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        dd(Settings()->get('show_warranty'));
        $form = [
            "title" => '',
            "description" => '',
            "product_sku" => '',
            "model_no" => '',
            "barcode" => '',
            "manage_inventory" => '',
            "quantity" => '',
            "product_types" => '',
            "cost_price" => '',
            "selling_price" => '',
            "start_date" => '',
            "end_date" => '',
            "product_category" => '',
            "brand_id" => '',
            "head_id" => '',
            "weight" => 0,

            'group' => [
                'attribute_value' => [],
            ],
            'attribute_value' => [],
            'ghi' => [],
            'test' => [],
            'variation' => [],
            // Settings()->get('show_warranty'),


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
        $category = null;
        $category1 = null;
        $meta_key = null;
        $addo_product = [];
        $relado_product = [];
        $categories = [];
        $variation_product = null;
        if (isset($request->categoryies)) {
            foreach ($request->categoryies as $categorie) {
                $categories[] = $categorie['id'];
//                $categories1[] = $categorie['title'];
            }
        }
        if (isset($request->addon_product)) {
            foreach ($request->addon_product as $addon_produc) {
                $addo_product[] = $addon_produc['id'];
            }
        }
        if (isset($request->related_product)) {
            foreach ($request->related_product as $related_produc) {
                $relado_product[] = $related_produc['id'];
            }
        }
        if (isset($request->meta)) {
            $meta_key = implode(",", $request->meta);
        }

        $un_vari = null;

        if (isset($request->variation)) {
            foreach ($request->variation as $key => $val) {
                $un_vari[$key] = $val;
            }
        }
        if (isset($request->variation)) {
            foreach ($request->test as $key => $val) {
                $prd[] = $val;
                $prd[$key]['variation'] = $un_vari[$key];
            }
        }
        if (isset($request->variation)) {
            foreach ($prd as $product_values) {
                if ($product_values['variation'] == '1') {
                    $variation_product[] = $product_values;
                } else {
                    $non_variation_product[] = $product_values;
                }
            }
        }

        if (isset($variation_product)) {
            $elements = count($variation_product);
            for ($i = 0; $i < $elements; $i++) {
                if (array_key_exists('variation', $variation_product[$i])) {
                    if ($variation_product[$i]['variation'] == "1") {
                        unset($variation_product[$i]['variation']);
                    }
                }
            }
        }
        if (isset($non_variation_product)) {
            $elements = count($non_variation_product);
            for ($i = 0; $i < $elements; $i++) {
                if (array_key_exists('variation', $non_variation_product[$i])) {
                    if ($non_variation_product[$i]['variation'] == "0") {
                        unset($non_variation_product[$i]['variation']);
                    }
                }
            }
        }
        if (isset($variation_product)) {
            $colour = $variation_product[0];
            $size = $variation_product[1];
//            $print = $variation_product[2];
            $res = $this->getCombinations($colour, $size);
            $count = count($variation_product);
//dd($res);
        }
        if (isset($res)) {
            foreach ($res as $item) {
                $arr = $item;
            }
        }

        $vari_id = ProductAttributeValue::where('id', 3)->first();
        $addon_pro = implode(",", $addo_product);
        $related_pro = implode(",", $relado_product);
        $category = implode(",", $categories);
//        $category1 = implode(",", $categories1);

        $product = new Product;
        $product->fill($request->all());

        if ($request->hasfile('SizeImgs')) {

            $file = $request->file('SizeImgs');
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
        }
        DB::transaction(function () use ($request, $product, $category, $addon_pro, $related_pro) {
            //multi img work
            if ($request->uploads != null) {
                $file = $request->file('uploads');

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
                    $product_image->products = $product->id;
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

//                          foreach ($file as $image) {
//                    $building_image = new Product_Image();
//                    $name = str::random(10) . '.' . $image->extension();
//                    $building_image->products = $product->id;
//                    $building_image->title = $image->getClientOriginalName();
//                    $building_image->images = $name;
////                  $building_image->size = $image->getSize();
////                  $building_image->type = $image->extension();
//                    $image->move($path, $name);
//                    $building_image->save();
//                }
            }

//            $separate_tags1 = explode(',', $category1);
            $product_category = explode(',', $category);
            foreach ($product_category as $separate_tag) {
                $product_category_master = new Category_master;
                $product_category_master->product_id = $product->id;

                $product_category_master->category_id = $separate_tag;
                $product_category_master->save();
            }

            $addon = explode(',', $addon_pro);
            foreach ($addon as $separate_tag1) {
                $addon_master = new Addon_master();
                $addon_master->product_id = $product->id;
                $addon_master->addon_id = $separate_tag1;
                $addon_master->save();
            }
            $related_product = explode(',', $related_pro);
            foreach ($related_product as $separate_tag2) {
                $related_product_master = new Related_product_master();
                $related_product_master->product_id = $product->id;
                $related_product_master->related_product_id = $separate_tag2;
                $related_product_master->save();
            }


        });


        // dd($request->all());
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:255',
            'product_sku' => 'required|max:25',
            'model_no' => 'required|max:25',
            'barcode' => 'required|max:25',
            'cost_price' => 'required|max:25',
            'selling_price' => 'required|max:25',
            'category' => 'required|max:25',
            'brand_id' => 'required|max:25',
        ]);

        $model = new Product();
        $model->fill($request->all());
//        dd($model);
        $model->save();

        foreach ($request->product_img as $key => $item) {

            if (isset($item['img'])) {
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


        return response()->json(["saved" => true, "id" => $model->id]);
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
            'product_sku' => 'required|max:25',
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
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }

    public function product_excel(Request $request)
    {
//        dd($request);
        $data = Product::with('category', 'brand', 'product_img')->get();
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
