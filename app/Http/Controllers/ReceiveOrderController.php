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
                            $abc->save();
                            $product = Product::where('id', $product_id)->first();
                            $product->quantity += $total_quantity;
                            $product->save();
                        }
                    }
                    $purchases = Purchase_item::where('purchase_id', $request->id)->where('product_id', $data['product_id'])->first();
                    $purchases->partail_remaining = $quantity - $totalQtyDeliver;
                    $purchases->save();
                    $rrr += $totalQtyDeliver;
                    $qqq += $quantity;
                }
                if ($totalQtyDeliver < $quantity) {
                    $status = Purchase::where('id', $request->id)->first();
                    $status->status_id = 29;
                    $status->save();
                    $abcd = 1;
                }
                elseif ($abcd != 1) {
                    $status = Purchase::where('id', $request->id)->first();
                    $status->status_id = 27;
                    $status->save();
                }
                $number = Counter::where('key', 'receivable_order');
                $model = new Receive_order();
                $model->fill($request->all());
                $model->number = ($number->first()->prefix . $number->first()->value);
                $model->purchase_order_id = $request->id;
                $model->user_id = Auth::user()->id;
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
                    ]);
                    $number->update([
                        'value' => ($number->first()->value + 1)
                    ]);
                    return $model;
                });
            }
            $purchase = Purchase::where('id', $request->id)->first();
            $purchase->partial_remaining -= $rrr;
            $purchase->save();
        } else {
            foreach ($request->items as $data) {
                $totalQtyDeliver = 0;
                $product_id = $data['product_id'];
                $quantity = $data['qty'];
                $total_quantity = $data['total_qty_deliver'] ?? 0;
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
                            $product->cost_price = $data['unit_price'];
                            $product->save();
                        } else {
                            $abc = new Inventory();
                            $abc->product_id = $product_id;
                            $abc->warehouse_id = $child['warehouse_id'];
                            $abc->qty = $child['qty_deliver'];
                            $abc->save();
                            $product = Product::where('id', $product_id)->first();
                            $product->quantity = $total_quantity;
                            $product->cost_price = $data['unit_price'];
                            $product->save();
                        }
                    }
                }
                if ($totalQtyDeliver < $quantity) {
                    $status = Purchase::where('id', $request->id)->first();
                    $status->status_id = 29;
                    $status->save();
                    $abcd = 1;
                } elseif ($abcd != 1) {
                    $status = Purchase::where('id', $request->id)->first();
                    $status->status_id = 27;
                    $status->save();
                }
                $purchases = Purchase_item::where('purchase_id', $request->id)->where('product_id', $data['product_id'])->first();
                $purchases->partail_remaining = $quantity - $totalQtyDeliver;
                $purchases->save();
                $rrr += $totalQtyDeliver;
                $qqq += $quantity;
            }
            $purchase = Purchase::where('id', $request->id)->first();
            $purchase->partial_remaining = $qqq - $rrr;
            $purchase->save();
            $number = Counter::where('key', 'receivable_order');

            $model = new Receive_order();
            $model->fill($request->all());
            $model->number = ($number->first()->prefix . $number->first()->value);
            $model->purchase_order_id = $request->id;
            $model->user_id = Auth::user()->id;
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
                ]);
                $number->update([
                    'value' => ($number->first()->value + 1)
                ]);
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
