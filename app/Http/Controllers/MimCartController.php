<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MimCartController extends Controller
{
    public function fetchData(Request $request)
    {
        $apiUrl = $request->mim_store_address . '/account_services/get_orders?appkey=' . $request->mim_api_key;
        try {
            // Make the HTTP GET request with headers using the Http facade
            $response = Http::get($apiUrl);
            // Check if the request was successful
            if ($response->successful()) {
                $data = $response->json(); // No need to decode JSON manually
                // return response()->json($data);
                return response()->json(['data' => true]);
            } else {
                // Handle the error, e.g., log it or return an error response
                return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }
        } catch (Throwable $e) {
            return response()->json(['mimCart_error' => $e->getMessage()]);
        }
    }

    public function storeOrder($id)
    {
        $store = Store::findOrFail($id);
        if (isset($store) && $store->plate_form == 'MimCart') {
            $apiUrl = $store->mim_store_address . '/account_services/get_orders?appkey=' . $store->mim_api_key;
            try {
                $response = Http::get($apiUrl);
                if ($response->successful()) {
                    $i = 0;
                    foreach ($response->json() as $rec) {
                        $order = Order::where('external_order_no', $rec['id'])->where('order_form', 'MimCart');
                        if (!$order->first()) {
                            ++$i;
                            $order = new Order();
                            $order->order_form = 'MimCart';
                            $order->external_order_no = $rec['id'];
                            $order->name = $rec['name'];
                            if ($rec['mobile']) {
                                $customer = Customer::where('phone', $rec['mobile'])->first();
                                if ($customer) {
                                    $order->customer_id = $customer['id'];
                                } else {
                                    $customer = new Customer();
                                    $customer->name = $rec['name'];
                                    $customer->s_address_1 = $rec['address'];
                                    $customer->b_address_1 = $rec['address'];
                                    $customer->email = $rec['email'];
                                    $customer->phone = $rec['mobile'];
                                    $customer->save();
                                    $order->customer_id = $customer['id'];
                                }
                            }
                            $order->email = $rec['email'];
                            $order->phone = $rec['mobile'];
                            $order->s_addres_1 = $rec['address'];
                            $order->instraction = $rec['instructions'];
                            $order->city_id = $rec['city'];
                            $order->store_id = $id;
                            $order->shipping_charges = $rec['shipping_charges'];
                            $items = [];
                            foreach ($rec['items'] as $key => $item) {
                                $product = null;
                                $product = Product::where('product_sku', $item['code'])->first();
                                if (!$product) {
                                    $product = new Product();
                                    $product->product_sku = $item['code'];
                                    $product->title = $item['title'];
                                    $product->selling_price = $item['price'];
                                    $product->cost_price = $item['price'];
                                    $product->save();
                                }
                                $items[$key]['product_id'] = $product['id'];
                                $items[$key]['title'] = $item['title'];
                                $items[$key]['qty'] = $item['qty'];
                                $items[$key]['value_inc_tax'] = $item['total'];
                                $items[$key]['unit_price'] = $item['price'];
                                $items[$key]['coupon_discount'] = $item['coupon_discount'];
                                $items[$key]['discount'] = $item['discount'];
                            }
                            $order->storeHasMany([
                                'items' => $items
                            ]);
                        }
                    }
                    return response()->json(['saved' => true, 'new' => $i]);
                } else {
                    return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
                }
            } catch (Throwable $e) {
                return response()->json(['mimCart_error' => $e->getMessage()]);
            }
        }
    }
}
