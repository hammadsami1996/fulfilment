<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopifyController extends Controller
{
    public function fetchData(Request $request)
    {
        $apiUrl = $request->store_address . '/admin/api/2023-07/orders.json?status=any';
        $headers = [
            'X-Shopify-Access-Token' => $request->access_token,
        ];
        try {
            // Make the HTTP GET request with headers using the Http facade
            $response = Http::withHeaders($headers)->get($apiUrl);
            // Check if the request was successful
            if ($response->successful()) {
                $data = $response->json(); // No need to decode JSON manually
                // $this->storeOrder(1);
                // return response()->json($data);
                return response()->json(['data' => true]);

            } else {
                // Handle the error, e.g., log it or return an error response
                return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }
        } catch (Throwable $e) {
            return response()->json(['shopify_error' => $e->getMessage()]);
            return false;
        }
        // $api_url = 'https://arh-store-7777.myshopify.com/admin/api/2023-07/';
        // $access_token = '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';


    }


    public function storeOrder($id)
    {
        $store = Store::findOrFail($id);
        if (isset($store) && $store->plate_form == 'Shopify') {
            $apiUrl = $store->store_address . '/admin/api/2023-07/orders.json?status=any';
            $headers = [
                'X-Shopify-Access-Token' => $store->access_token,
            ];
            try {
                $response = Http::withHeaders($headers)->get($apiUrl);
                if ($response->successful()) {
                    $shopify = $response->json();
                    $i = 1;
                    foreach ($shopify['orders'] as $rec) {
                        $order = Order::where('external_order_no', $rec['id'])->where('order_form', 'Shopify');
                        if (!$order->first()) {
                            $i++;
                            $order = new Order();
                            $order->order_form = 'Shopify';
                            $order->external_order_no = $rec['id'];
                            if ($rec['customer']['phone']) {
                                $customer = Customer::where('phone', $rec['customer']['phone'])->first();
                                if ($customer) {
                                    $order->customer_id = $customer['id'];
                                } else {
                                    $customer = new Customer();
                                    $customer->name = $rec['customer']['first_name'];
                                    $customer->s_address_1 = $rec['customer']['default_address']['address1'] . $rec['customer']['default_address']['address2'];
                                    $customer->b_address_1 = $rec['customer']['default_address']['address1'] . $rec['customer']['default_address']['address2'];
                                    $customer->email = $rec['customer']['email'];
                                    $customer->phone = $rec['customer']['phone'];
                                    $b_city = City::where('name', $rec['billing_address']['city'])->first();
                                    $customer->b_city_id = $b_city['id'];
                                    $customer->b_country_id = $b_city['country_id'];
                                    $customer->b_name = $rec['billing_address']['first_name'];
                                    $customer->b_phone = $rec['billing_address']['phone'];
                                    $customer->b_address_1 = $rec['billing_address']['address1'];
                                    $customer->b_address_2 = $rec['billing_address']['address2'];
                                    if ($rec['shipping_address']) {
                                        $s_city = City::where('name', $rec['shipping_address']['city'])->first();
                                        if ($s_city) {
                                            $customer->s_city_id = $s_city['id'];
                                            $customer->s_country_id = $s_city['country_id'];
                                        }
                                    }
                                    $customer->s_name = $rec['shipping_address']['first_name'];
                                    $customer->s_phone = $rec['shipping_address']['phone'];
                                    $customer->s_address_1 = $rec['shipping_address']['address1'];
                                    $customer->s_address_2 = $rec['shipping_address']['address2'];
                                    $customer->save();
                                    $order->customer_id = $customer['id'];
                                }
                            }
                            $order->name = $rec['customer']['first_name'];
                            $order->email = $rec['customer']['email'];
                            $order->phone = $rec['customer']['phone'];
                            $order->address = $rec['customer']['default_address']['address1'] . $rec['customer']['default_address']['address2'];

                            $order->shipping_charges = $rec['total_shipping_price_set']['presentment_money']['amount'];
                            $order->total = $rec['total_price'];
                            $order->discount = $rec['total_discounts'];
                            $order->subTotal = $rec['total_line_items_price'];

                            $order->tax = $rec['total_tax'];
                            $order->tracking_id = $rec['cart_token'];
                            $order->payment_method = $rec['payment_gateway_names'][0];

                            $order->status_id = 1;

                            $items = [];
                            foreach ($rec['line_items'] as $key => $item) {
                                $product = Product::where('product_sku', $item['sku'])->first();
                                if (!$product) {
                                    $product = new Product();
                                    $product->product_sku = $item['sku'];
                                    $product->title = $item['title'];
                                    $product->selling_price = $item['price'];
                                    $product->cost_price = $item['price'];
                                    $product->save();
                                }
                                $items[$key]['qty'] = $item['quantity'];
                                $items[$key]['product_id'] = $product['id'];
                                $items[$key]['unit_price'] = $item['price'];
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
