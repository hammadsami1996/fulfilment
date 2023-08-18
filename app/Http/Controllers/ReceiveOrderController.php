<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Purchase_item;
use App\Models\Receive_order;
use Illuminate\Http\Request;
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

        $model = Purchase::with('supplier', 'items.product.product_img')->findOrFail($id);

        return response()->json([
            "form" => $model
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->status_id);
        $request->validate([
            'supplier_id' => 'required',

            'date' => 'required',


        ]);
        $abcd = 0;
        $rrr = 0;
        $qqq = 0;
        if ($request->status_id == 29) {
            foreach ($request->items as $data) {

                $totalQtyDeliver = 0;


                $product_id = $data['product_id'];
                $quantity = $data['partail_remaining'];
                if (isset($data['total_qty_deliver'])) {
                    $total_quantity = $data['total_qty_deliver'];

                }


                if (isset($data['child'])) {
                    foreach ($data['child'] as $child) {

                        $totalQtyDeliver += $child['qty_deliver'];

                        $first = Inventory::where('product_id', $product_id)->where('warehouse_id', $child['warehouse_id'])->first();
                        if ($first != null) {

                            $first = Inventory::where('product_id', $product_id)->where('warehouse_id', $child['warehouse_id'])->first();
                            $first->qty += $child['qty_deliver'];
                            $first->save();
                            $product = Product::where('id', $product_id)->first();
                            $product->quantity += $total_quantity;

                            $product->save();


                        } else {

                            $abc = new Inventory();
                            $abc->product_id = $product_id;
                            $abc->warehouse_id = $child['warehouse_id'];
                            $abc->qty = $child['qty_deliver'];
                            // $abc->price = $child['unit_price'];
                            $abc->save();

                            $product = Product::where('id', $product_id)->first();
                            $product->quantity = $total_quantity;
                            $product->save();
                        }

                        // }


                    }
                    // }


                    if ($totalQtyDeliver < $quantity) {

                        // dd($child['qty_deliver']);
                        $status = Purchase::where('id', $request->id)->first();

                        $status->status_id = 29;
                        $status->save();
                        $abcd = 1;
                    } // dd($abcd);
                    elseif ($abcd != 1) {
                        // dd($totalQtyDeliver);
                        $status = Purchase::where('id', $request->id)->first();

                        $status->status_id = 27;
                        $status->save();
                    }
                    // dd($totalQtyDeliver);
                    $purchases = Purchase_item::where('purchase_id', $request->id)->where('product_id', $data['product_id'])->first();

                    $purchases->partail_remaining = $quantity - $totalQtyDeliver;
                    $purchases->save();
                    // dd($totalQtyDeliver);


                    $rrr += $totalQtyDeliver;
                    $qqq += $quantity;
                }
                // dd($qqq);
                $purchase = Purchase::where('id', $request->id)->first();
                $purchase->partial_remaining = $qqq - $rrr;
                $purchase->save();
                // dd($purchase);
                $number = Counter::where('key', 'receivable_order');

                $model = new Receive_order();
                $model->fill($request->all());
                $model->number = ($number->first()->perfix . $number->first()->value);
                $model->purchase_order_id = $request->id;
                $model->user_id = Auth::user()->id;
                //   $model->save();

                // $model->tax = $request->mtax_amount;
                // $model->total = $request->finaltotal;
                // $model->sub_total = $request->tvalue_ex_tax;
                $items = collect($request->items)->map(function ($item) {
                    if ($item['qty'] > 0) {
                        $item['purchase_order_item_id'] = $item['id'];
                        $item['qty'] = $item['qty'];
                        $item['tax_amount'] = round(($item['qty'] * $item['unit_price']) * ($item['tax_percent'] / 100), 2);
                        $item['value_ex_tax'] = round(($item['qty'] * $item['unit_price']), 2);
                        $item['value_inc_tax'] = round(($item['qty'] * $item['unit_price']) + $item['tax_amount'], 2);
                        return $item;
                    }


                });
                $model = DB::transaction(function () use ($model, $items, $number, $request) {


                    $model->storeHasMany([

                        'items' => $items,

                        // 'purchase_order_item_id' => $request->items->id,
                    ]);

                    $number->update([
                        'value' => ($number->first()->value + 1)
                    ]);
                    // $status = Purchase::where('id' , $request->id)->first();
                    // // dd($status);
                    // $status->status_id = 27;
                    // $status->save();
                    return $model;


                });
            }
        } else {


            foreach ($request->items as $data) {
                // dd($data['total_qty_deliver']);
                $totalQtyDeliver = 0;

                // dd($data['total_qty_deliver']);
                $product_id = $data['product_id'];
                $quantity = $data['qty'];
                $total_quantity = $data['total_qty_deliver'];

                // dd($total_quantity);
                // foreach($data['child'] as $child){
                //     // dd($totalQtyDeliver +=$child['qty_deliver']);
                //     $totalQtyDeliver += $child['qty_deliver'];
                // }
                // dd($totalQtyDeliver);

                foreach ($data['child'] as $child) {
                    // dd($child);
                    // dd($totalQtyDeliver +=$child['qty_deliver']);
                    $totalQtyDeliver += $child['qty_deliver'];
                    // if($quantity < $totalQtyDeliver){
                    //     return response()->json(["error" => true]);
                    // }
                    // else{
                    $first = Inventory::where('product_id', $product_id)->where('warehouse_id', $child['warehouse_id'])->first();
                    if ($first != null) {

                        $first = Inventory::where('product_id', $product_id)->where('warehouse_id', $child['warehouse_id'])->first();
                        $first->qty += $child['qty_deliver'];
                        $first->save();
                        $product = Product::where('id', $product_id)->first();
                        $product->quantity += $total_quantity;
                        // $product->quantity = $quantity;
                        $product->save();
                        // dd($first);

                    } // dd($child['warehouse_id']);
                    else {

                        $abc = new Inventory();
                        $abc->product_id = $product_id;
                        $abc->warehouse_id = $child['warehouse_id'];
                        $abc->qty = $child['qty_deliver'];
                        // $abc->price = $child['unit_price'];
                        $abc->save();

                        $product = Product::where('id', $product_id)->first();
                        $product->quantity = $total_quantity;
                        $product->save();
                    }

                    // }


                }


                if ($totalQtyDeliver < $quantity) {

                    // dd($child['qty_deliver']);
                    $status = Purchase::where('id', $request->id)->first();

                    $status->status_id = 29;
                    $status->save();
                    $abcd = 1;
                } // dd($abcd);
                elseif ($abcd != 1) {
                    // dd($totalQtyDeliver);
                    $status = Purchase::where('id', $request->id)->first();

                    $status->status_id = 27;
                    $status->save();
                }
                // dd('abcd');
                // dd($totalQtyDeliver);
                $purchases = Purchase_item::where('purchase_id', $request->id)->where('product_id', $data['product_id'])->first();

                $purchases->partail_remaining = $quantity - $totalQtyDeliver;
                $purchases->save();
                // dd($totalQtyDeliver);


                $rrr += $totalQtyDeliver;
                $qqq += $quantity;
            }
            // dd($qqq);
            $purchase = Purchase::where('id', $request->id)->first();
            $purchase->partial_remaining = $qqq - $rrr;
            $purchase->save();
            // dd($purchase);
            $number = Counter::where('key', 'receivable_order');

            $model = new Receive_order();
            $model->fill($request->all());
            $model->number = ($number->first()->perfix . $number->first()->value);
            $model->purchase_order_id = $request->id;
            $model->user_id = Auth::user()->id;
            //   $model->save();

            // $model->tax = $request->mtax_amount;
            // $model->total = $request->finaltotal;
            // $model->sub_total = $request->tvalue_ex_tax;
            $items = collect($request->items)->map(function ($item) {
                if ($item['qty'] > 0) {
                    $item['purchase_order_item_id'] = $item['id'];
                    $item['qty'] = $item['qty'];
                    $item['tax_amount'] = round(($item['qty'] * $item['unit_price']) * ($item['tax_percent'] / 100), 2);
                    $item['value_ex_tax'] = round(($item['qty'] * $item['unit_price']), 2);
                    $item['value_inc_tax'] = round(($item['qty'] * $item['unit_price']) + $item['tax_amount'], 2);
                    return $item;
                }


            });
            $model = DB::transaction(function () use ($model, $items, $number, $request) {

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
                // $status = Purchase::where('id' , $request->id)->first();
                // // dd($status);
                // $status->status_id = 27;
                // $status->save();
                return $model;


            });
        }
        return response()->json(["saved" => true, "id" => $model->id]);
    }


    public function inventory(Request $request)
    {

        // dd($request->all());
        foreach ($request->all() as $data) {
            $product_id = $data['product_id'];
            $quantity = $data['qty_received'];
            // dd($data['child']);
            foreach ($data['child'] as $child) {

                if ($quantity < $child['qty_deliver']) {
                    return response()->json(["error" => true]);
                } else {
                    // dd($child['warehouse_id']);
                    $abc = new Inventory();
                    $abc->product_id = $product_id;
                    $abc->warehouse_id = $child['warehouse_id'];
                    $abc->qty = $child['qty_deliver'];
                    $abc->price = $child['unit_price'];
                    $abc->save();

                    $product = Product::where('id', $product_id)->first();
                    $product->quantity = $quantity;
                    $product->save();
                }


            }


        }
        return response()->json(["saved" => true, "id" => $abc->id]);

    }

}
