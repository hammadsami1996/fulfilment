<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderViews;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => OrderViews::with('customer', 'items.product', 'stores', 'status')
            ->when(\request()->has('status_id') && \request('status_id') != 0, function ($q) {
                $q->where('status_id', \request('status_id'));
            })->when(\request()->has('packability'), function ($q) {
                $q->where('packability', \request('packability'));
            })->search()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "store_id" => '',
            "order_date" => '',
            "so_number" => '',
            "customer_id" => '',
            "city" => '',
            "total" => '',
            "tax" => '',
            "balance" => '',
            "courier" => '',
            "payment_status" => '',
            "location" => '',
            "sales_rep" => '',
            "selling_price" => '',
            "external_order_no" => '',
            "tracking_id" => '',
            "product_id" => '',
            "subTotal" => '',
            "discount" => '',
            'discount_percent' => 0,
            'selling_price' => 0,


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
//            dd($request->items);
        $request->validate([
//            'store' => 'required',
//            'order_date' => 'required',
//            'customer_id' => 'required',
//            'city' => 'required',
//            'total' => 'required',
//            'tax' => 'required',
//            'balance' => 'required',
//            'courier' => 'required',
//            'payment_status' => 'required',
//            'location' => 'required',
//            'sales_rep' => 'required',
//            'selling_price' => 'required',
            // 'external_order_no' => 'required',
            // 'tracking_id' => 'required',
        ]);
//        $wearhouse = $request->warehouse_id;
////         dd($request->warehouse_id);
//        foreach ($request->items as $numbers) {
//            $product = Product::where('id', $numbers['product_id'])->value('quantity');
//            if ($product >= $numbers['qty']) {
//                $inventory = Inventory::where('product_id', $numbers['product_id'])->where('warehouse_id', $wearhouse)->value('qty');
//                // dd($inventory);
//                if ($inventory < $numbers['qty']) {
//
//                    return response()->json(["error" => true]);
//
//                }
//            } else {
//                return response()->json(["error" => true]);
//            }
//            // dd($number['product_id']);
//
//
//        }
        $c = Customer::where('phone', $request->phone)->first();
        if (!$c) {
            $Customer = new Customer();
            $Customer->name = $request->name;
            $Customer->email = $request->email;
            $Customer->phone = $request->phone;
            $Customer->s_address_1 = $request->address;
            $Customer->b_address_1 = $request->address;
            $Customer->save();
        }

        $number = Counter::where('key', 'sales_order');
        $model = new Order();
        $model->fill($request->except('items'));
        if (!$c && $Customer['id']) {
            $model->customer_id = $Customer['id'];
        }
        $model->so_number = ($number->first()->perfix . $number->first()->value);

        $model->subTotal = collect($request->items)->sum(function ($item) {
            return $item['qty'] * $item['unit_price'];
        });

        $model->tax = $request->mtax_amount;
        $model->total = $request->finaltotal;
//        $model->so_number = ($number->first()->perfix . $number->first()->value);

        $model->storeHasMany([
            'items' => $request->items
        ]);

        $number->update([
            'value' => ($number->first()->value + 1)
        ]);
//        $number->update([
//            'value' => ($number->first()->value + 1)
//        ]);
//        $wearhouses = $request->warehouse_id;
//        // dd($request->warehouse_id);
//        foreach ($request->items as $number) {
//            // dd($number['product_id']);
//            $inventory = Inventory::where('product_id', $number['product_id'])->where('warehouse_id', $wearhouses);
//            $inventory->update([
//                'qty' => ($inventory->first()->qty - $number['qty'])
//            ]);
//            $product = Product::where('id', $number['product_id']);
//            $product->update([
//                'quantity' => ($product->first()->quantity - $number['qty'])
//            ]);
//            // dd($number['qty']);
//        }

        // $inventory = Inventory::where('product_id' , );
//        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Order::with('customer', 'items.product', 'stores', 'wearhouse')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Order::with('customer', 'items.product', 'stores', 'wearhouse')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, $id)
//    {
//        $request->validate([
//            'order_date' => 'required',
//            'customer_id' => 'required',
//            'selling_price' => 'required',
//        ]);
//        $c = Customer::where('phone', $request->phone)->first();
//        if (!$c) {
//            $Customer = new Customer();
//            $Customer->name = $request->name;
//            $Customer->email = $request->email;
//            $Customer->phone = $request->phone;
//            $Customer->s_address_1 = $request->address;
//            $Customer->b_address_1 = $request->address;
//            $Customer->save();
//        }
//        $model = Order::findOrFail($id);
//        $model->fill($request->except('items'));
//        if (!$c && $Customer['id']) {
//            $model->customer_id = $Customer['id'];
//        }
//        $model->updateHasMany([
//            'items' => $request->items
//        ]);
////        $model->save();
//        return response()->json(["saved" => true, "id" => $model->id]);
//    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'order_date' => 'required',
            'customer_id' => 'required',
            'selling_price' => 'required',
        ]);

        $customer = Customer::where('phone', $request->phone)->first();

//        if (!$customer) {
//            $customer = new Customer();
//            $customer->name = $request->name;
//            $customer->email = $request->email;
//            $customer->phone = $request->phone;
//            $customer->s_address_1 = $request->address;
//            $customer->b_address_1 = $request->address;
//            $customer->save();
//        }

        $order = Order::findOrFail($id);
        $order->fill($request->except('items'));

        // Update the customer ID for the order if a customer with the provided phone exists
        if ($customer) {
            $order->customer_id = $customer->id;
        }

        // Assuming you have a method named 'updateHasMany' in your Order model to update related items
        $order->updateHasMany([
            'items' => $request->items
        ]);

        $order->save(); // Save the changes to the order

        return response()->json(["saved" => true, "id" => $order->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Order::with('customer', 'items', 'stores')->findOrFail($id);
        // $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }


    public function remain(Request $request)
    {
        // dd($request[1]);
        $product_id = $request[0];
        $warehouse = $request[1];
        $inventory = Inventory::where('product_id', $product_id)->where('warehouse_id', $warehouse)->value('qty');
        // dd($inventory);
        return response()->json(["data" => $inventory]);

    }


}
