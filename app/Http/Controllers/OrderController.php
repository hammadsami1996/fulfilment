<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Customer;
use App\Models\Delivery_Charges;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\OrderViews;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => OrderViews::with('customer', 'items.product', 'stores.company', 'status', 'courier', 'city', 'stores', 'warehouse')
            ->when(\request()->has('status_id') && \request('status_id') != 0, function ($q) {
                $q->where('status_id', \request('status_id'));
            })->when(\request()->has('packability'), function ($q) {
                $q->where('packability', \request('packability'));
            })->when(\request()->has('city_id') && \request('city_id'), function ($q) {
                $q->where('city_id', \request('city_id'));
            })->when(\request()->has('customer_id') && \request('customer_id'), function ($q) {
                $q->where('customer_id', \request('customer_id'));
            })->when(\request()->has('courier_id') && \request('courier_id'), function ($q) {
                $q->where('courier_id', \request('courier_id'));
            })->when(\request()->has('quantity') && \request('quantity'), function ($q) {
                $q->where('quantity', \request('quantity'));
            })
            // ->when(\request()->has('order_type_id') && \request('order_type_id'), function ($q) {
            //     $q->where('order_type_id', \request('order_type_id'));
            ->when(\request()->has('discount') && \request('discount'), function ($q) {
                $q->where('discount_status', \request('discount'));
            })->when(\request()->has('payment_status') && \request('payment_status'), function ($q) {
                $q->where('payment_status', \request('payment_status'));
            })
            ->orderBy('id', 'desc')
            ->search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "store_id" => '',
            "warehouse_id" => '',
            "order_date" => '',
            "so_number" => '',
            "customer_id" => '',
            "city_id" => '',
            "total" => '',
            "tax" => '',
            "balance" => '',
            "payment_status" => '',
            "location" => '',
            "sales_rep" => '',
            "selling_price" => '',
            "external_order_no" => '',
            "tracking_id" => '',
            "product_id" => '',
            "sub_total" => '',
            "discount" => '',
            'discount_percent' => 0,
            'selling_price' => 0,
            'courier_id' => '',
            'quantity' => '',
            // 'order_type_id' => '',
            'payment_status' => '',
            'delivery_charges' => '',
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
//        dd($request->all());
        //    dd($request->warehouse_id);
        $request->validate([
            'store_id' => 'required',
            'order_date' => 'required',
            // 'customer_id' => 'required',
            // 'warehouse_id' => 'required',
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
        $c = Customer::where(function ($query) use ($request) {
            $query->where('phone', $request->b_phone)
                ->orWhere('phone', $request->s_phone);
        })->first();
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
        $model->so_number = ($number->first()->prefix . $number->first()->value);

        $model->sub_total = collect($request->items)->sum(function ($item) {
            return $item['qty'] * $item['unit_price'];
        });

        $store = Store::find($request->store_id);
        $company_id = $store->company_id;
//        dd($store->company_id);
        $model->company_id = $company_id;
//        dd($model->company_id);

        $model->tax = $request->mtax_amount;
        $model->total = $request->finaltotal;
        $model->storeHasMany([
            'items' => collect($request->items)->map(function ($item) use ($request) {
                $item['warehouse_id'] = $request->warehouse_id; // Add warehouse_id to each item
                return $item;
            })
        ]);
        $number->update([
            'value' => ($number->first()->value + 1)
        ]);
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Order::with('customer', 'items.product', 'stores', 'warehouse', 'courier')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Order::with('city', 'customer', 'items.product', 'stores', 'warehouse', 'status_logs.status', 'status_logs.user', 'courier')->findOrFail($id);
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
//            'order_date' => 'required',
//            'customer_id' => 'required',
//            'selling_price' => 'required',
        ]);
        $customer = Customer::where(function ($query) use ($request) {
            $query->where('phone', $request->b_phone)
                ->orWhere('phone', $request->s_phone);
        })->first();

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

        return response()->json(["saved" => true, "id" => $order->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Order::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
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

    public function details()
    {
//         dd(request('id'));
        $data = Order_item::where('product_id', request('id'))->pluck('order_id')->unique();
        return response()->json(["data" => $data]);
    }

    public function get_delivery_charges($id)
    {
        $model = Delivery_Charges::where('city_id', $id)->where('weight', '<=', \request('id'))->orderBy('weight', 'DESC')->first();

        if (!$model) {
            $model = Delivery_Charges::where('country_id', $id)->where('weight', '<=', \request('id'))->orderBy('weight', 'DESC')->first();
        }
        if (!$model) {
            $model = 0;
        }
        return response()->json([
            "form" => $model
        ]);
    }

    public function bulk_courier(Request $request)
    {
        $selectedItems = $request['selectedItems']; // An array of item IDs
        $statusData = $request['selectedcourier']; // Status data to be applied to all items
//dd($statusData['id']);

        foreach ($selectedItems as $itemId) {
            $order = Order::findOrFail($itemId);
            $order->courier_id = $statusData['id'];
            $order->save();
        }
        return response()->json(['response' => true]);
    }
}
