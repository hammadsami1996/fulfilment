<?php

namespace App\Http\Controllers;

use App\Models\ProdductImg;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\Purchase;
use App\Models\Purchase_item;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
//use Maatwebsite\Excel\Facades\Excel;
use Response;
use Illuminate\Support\Facades\Auth;


// use Spatie\Backtrace\File;
// use Symfony\Component\HttpFoundation\Response;
class ProductController extends Controller
{
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
            "title" => '',
            "description" => '',
            "sku" => '',
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
        // dd($request->all());
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
        $model = Product::with('product_img', 'brand', 'category', 'supplier')->findOrFail($id);
//        $model->Settings()->get('company_name');

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
