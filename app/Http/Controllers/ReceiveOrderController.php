<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receive_order;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Inventory;


use App\Models\Counter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiveOrderController extends Controller
{


    public function index()
    {
        return response()->json(['data' => Receive_order::with('supplier')->search()]);

    }



    public function edit($id)
    {

        $model = Purchase::with('supplier','items.product')->findOrFail($id);

        return response()->json([
            "form" => $model
        ]);
    }


    public function store(Request $request)
    {
            // dd($request->all());
        $request->validate([
            'supplier_id' => 'required',

            'date' => 'required',
            'items.*.qty_received' =>'required',



        ]);

        foreach($request->items as $data){
            // dd($data);
            $product_id = $data['product_id'];
            $quantity = $data['qty_received'];
            // dd($quantity);
            foreach($data['child'] as $child){

                if($quantity < $child['qty_deliver']){
                    return response()->json(["error" => true]);
                }
                else{
                    $first = Inventory::where('product_id' , $product_id)->where('warehouse_id', $child['warehouse_id'])->first();
                    if($first !=null ){

                        $first = Inventory::where('product_id' , $product_id)->where('warehouse_id', $child['warehouse_id'])->first();
                        $first->qty += $child['qty_deliver'];
                        $first->save();
                        $product = Product::where('id', $product_id )->first();
                        $product->quantity += $quantity;
                    // $product->quantity = $quantity;
                    $product->save();
                        // dd($first);

                    }
                // dd($child['warehouse_id']);
                else{

                    $abc = new Inventory();
                    $abc->product_id = $product_id;
                    $abc->warehouse_id = $child['warehouse_id'];
                    $abc->qty = $child['qty_deliver'];
                    // $abc->price = $child['unit_price'];
                    $abc->save();

                    $product = Product::where('id', $product_id )->first();
                    $product->quantity = $quantity;
                    $product->save();
                }
            }


            }



        }
        $number = Counter::where('key', 'receivable_order');

        $model = new Receive_order();
        $model->fill($request->all());
        $model->number = ($number->first()->perfix . $number->first()->value);
      $model->purchase_order_id = $request->id;
      $model->user_id=Auth::user()->id;
    //   $model->save();

        // $model->tax = $request->mtax_amount;
        // $model->total = $request->finaltotal;
        // $model->sub_total = $request->tvalue_ex_tax;
        $items = collect($request->items)->map(function($item) {
            if($item['qty_received'] > 0) {
                $item['purchase_order_item_id'] = $item['id'];
                $item['qty'] = $item['qty_received'];
                $item['tax_amount'] = round(($item['qty'] * $item['unit_price']) * ($item['tax_percent'] / 100), 2);
                $item['value_ex_tax'] = round(($item['qty'] * $item['unit_price']), 2);
                $item['value_inc_tax'] = round(($item['qty'] * $item['unit_price']) + $item['tax_amount'], 2);
                return $item;
            }


        });
        $model = DB::transaction(function() use ($model, $items, $number ,$request) {

        // foreach($items as $itm){
        //     // dd($itm['qty']);
        //     // dd($itm['product']['id']);
        //     $id = $itm['product']['id'];
        //     $product = Product::findOrFail($id);
        //     $product->quantity = $itm['qty'];
        //     $product->save();
        // };

        // dd($product);



        // dd($items);
        $model->storeHasMany([

            'items' => $items,

            // 'purchase_order_item_id' => $request->items->id,
        ]);

        $number->update([
            'value' => ($number->first()->value + 1)
        ]);
        $status = Purchase::where('id' , $request->id)->first();
        // dd($status);
        $status->status_id = 27;
        $status->save();
        return $model;


    });
        return response()->json(["saved" => true, "id" => $model->id]);
    }


    public function inventory(Request $request){

        // dd($request->all());
        foreach($request->all() as $data){
            $product_id = $data['product_id'];
            $quantity = $data['qty_received'];
            // dd($data['child']);
            foreach($data['child'] as $child){

                if($quantity < $child['qty_deliver']){
                    return response()->json(["error" => true]);
                }
                else{
                // dd($child['warehouse_id']);
                $abc = new Inventory();
                $abc->product_id = $product_id;
                $abc->warehouse_id = $child['warehouse_id'];
                $abc->qty = $child['qty_deliver'];
                $abc->price = $child['unit_price'];
                $abc->save();

                $product = Product::where('id', $product_id )->first();
                $product->quantity = $quantity;
                $product->save();
            }


            }



        }
        return response()->json(["saved" => true, "id" => $abc->id]);

    }

}
