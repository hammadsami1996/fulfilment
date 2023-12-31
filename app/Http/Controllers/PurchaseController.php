<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Purchase_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    dd(request('status_id'));
        $purchase = Purchase::with('supplier', 'status')
        ->when(request('status_id') != 0 , function ($q) {
            // dd(request('status_id'));
            $q->where('status_id', 'LIKE', request('status_id'));
        })
        ->search();
        return response()->json(['data' => $purchase]);

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
//            "po_reference_number" => Counter()->next('purchase_order'),
            "po_date" => '',
            "due_date" => '',
            "discount" => 0,
            "sku" => '',
            "name" => '',
            "qty" => '',
            "tax" => '',
            "sub_total" => '',
            "total" => '',
            "discount_percent" => 0,

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
            // dd($request->items);

        $request->validate([
            'supplier_id' => 'required|max:15',
//            'po_number' => 'required',
            // 'po_reference_number' => 'required',
            'po_date' => 'required',
            'due_date' => 'required',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);
        $number = Counter::where('key', 'purchase_order');
        $model = new Purchase();
        $model->fill($request->all());
        $model->po_date = date('Y-m-d');
        $model->po_number = ($number->first()->perfix . $number->first()->value);
//        $model->po_reference_number = Counter()->next('purchase_order');
        $model->tax = $request->mtax_amount;
        $model->total = $request->finaltotal;
        $model->sub_total = $request->tvalue_ex_tax;
        $model->storeHasMany([
            'items' => $request->items
        ]);
        $number->update([
            'value' => ($number->first()->value + 1)
        ]);
//        Counter()->increase('purchase_order');
//        $number->update([
//            'value' => ($number->first()->value + 1)
//        ]);

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
        $model = Purchase::with('supplier' ,'items.product.product_img')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dd('ab');
        $request->validate([
            'supplier_id' => 'required|max:15',
//            'po_number' => 'required',
            // 'po_reference_number' => 'required',
            'po_date' => 'required',
            'due_date' => 'required',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.unit_price' => 'required|numeric|min:0',
            // 'discount' => 'required',
            // 'sku' => 'required',
//            'name' => 'required',
//            'qty' => 'required',
//            'purchasing_price' => 'required',
//            'tax' => 'required',
//            'sub_total' => 'required',
        ]);
        $model = Purchase::with('supplier')->findOrFail($id);
        $model->fill($request->all());
        $model->tax = $request->mtax_amount;
        $model->total = $request->finaltotal;
        $model->sub_total = $request->tvalue_ex_tax;

        $model->updateHasMany([
            'items' => $request->items
        ]);

//        $model->updated_by = Auth::id();
        // $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Purchase::with('supplier')->findOrFail($id);
       $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }

    public function details(){
        // dd(request('id'));
        $data = Purchase_item::where('product_id' , request('id'))->pluck('id');
        return response()->json(["data" => $data]);
    }
}
