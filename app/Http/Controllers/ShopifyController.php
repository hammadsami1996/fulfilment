<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\City_Courier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeGroup;
use App\Models\ProductAttributeValue;
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
            $apiUrl = $store->store_address . '/admin/api/2023-07/orders.json?status=any&limit=250';
//            dd($apiUrl);
            $headers = [
                'X-Shopify-Access-Token' => $store->access_token,
            ];
            try {
                $response = Http::withHeaders($headers)->get($apiUrl);
                if ($response->successful()) {
                    $shopify = $response->json();
//                    dd($shopify);
                    $i = 0;

                    foreach ($shopify['orders'] as $rec) {
                        $order = Order::where('external_order_no', $rec['id'])->where('order_form', 'Shopify')
                            ->where('store_id', $store->id)->first();
                        if (!$order) {
                            ++$i;
                            $order = new Order();
                            $order->store_id = $store->id;
                            $order->company_id = $store->company_id;
                            $order->order_date = $store->created_at;
                            $order->warehouse_id = $store->warehouse_id;
                            $order->order_form = 'Shopify';
                            $order->external_order_no = $rec['id'];
                            $order->tracking_id = $rec['confirmation_number'];
                            if ($rec['customer']['phone'] || $rec['billing_address']['phone']) {
                                $customer = Customer::where('phone', $rec['customer']['phone'] ?? $rec['billing_address']['phone'])->first();
                                if ($customer) {
                                    $order->customer_id = $customer['id'];
                                } else {
                                    $customer = new Customer();
                                    $customer->name = $rec['customer']['first_name'] . ' ' . $rec['customer']['last_name'];
                                    $customer->email = $rec['customer']['email'];
                                    $customer->phone = $rec['customer']['phone'] ?? $rec['billing_address']['phone'];
                                    $b_city = City::where('name', $rec['billing_address']['city'])->first();
                                    if ($b_city) {
                                        $customer->b_city_id = $b_city['id'];
                                        $customer->b_country_id = $b_city['country_id'];
                                    }
                                    $customer->b_name = $rec['billing_address']['name'];
                                    $customer->b_phone = $rec['billing_address']['phone'];
                                    $customer->b_address_1 = $rec['billing_address']['address1'] . ' ' . $rec['billing_address']['address2'];
                                    if ($rec['shipping_address']) {
                                        $s_city = City::where('name', $rec['shipping_address']['city'])->first();
                                        if ($s_city) {
                                            $customer->s_city_id = $s_city['id'];
                                            $customer->s_country_id = $s_city['country_id'];
                                        }
                                    }
                                    $customer->s_name = $rec['shipping_address']['name'];
                                    $customer->s_phone = $rec['shipping_address']['phone'];
                                    $customer->s_address_1 = $rec['shipping_address']['address1'] . ' ' . $rec['shipping_address']['address2'];
                                    $customer->save();
                                    $order->customer_id = $customer['id'];
                                }
                            }

                            $order->city_name = $rec['shipping_address']['city'];

                            $order->b_name = $rec['billing_address']['name'];
                            $order->b_phone = $rec['billing_address']['phone'];
                            $order->b_address_1 = $rec['billing_address']['address1'] . ' ' . $rec['billing_address']['address2'] . ' ' . $rec['billing_address']['city'];

                            $s_city = City::where('name', $rec['shipping_address']['city'])->first();
                            if ($s_city) {
                                $order->city_id = $s_city->id;
                                $cityCourier = City_Courier::where('city_id', $s_city->id)->first();
                                if ($cityCourier) {
                                    $order->courier_id = $cityCourier->courier_id;
//                                    $order->delivery_charges = $cityCourier->delivery_charges;
                                }
                            }
                            $order->s_name = $rec['shipping_address']['name'];
                            $order->s_phone = $rec['shipping_address']['phone'];
                            $order->s_address_1 = $rec['shipping_address']['address1'] . ' ' . $rec['shipping_address']['address2'] . ' ' . $rec['shipping_address']['city'];

                            $order->sub_total = $rec['subtotal_price'];
                            $order->tax = $rec['total_tax'];
                            $order->shipping_charges = $rec['total_shipping_price_set']['presentment_money']['amount'];
                            $order->discount = $rec['total_discounts'];
                            $order->net_total = $rec['total_price'];

                            if ($order->net_total > 0) {
                                $order->discount_percent = ($order->discount / $order->net_total) * 100;
                            } else {
                                $order->discount_percent = 0;
                            }

                            $order->payment_method = $rec['payment_gateway_names'][0];

                            $order->status_id = 1;

                            $items = [];
                            $totalQuantity = 0;
                            foreach ($rec['line_items'] as $key => $item) {
                                $parent_product = Product::where('title', $item['title'])->whereNull('head_id')->first();
                                if (!$parent_product) {
                                    $parent_product = new Product();
                                    $parent_product->title = $item['title'];
                                    $parent_product->selling_price = $item['price'];
                                    $parent_product->cost_price = $item['price'];
                                    $parent_product->save();
                                }
                                $product = Product::where('sku', $item['sku'] ? $item['sku'] : $item['product_id'])->whereNotNull('head_id')->first();

                                if (!$product) {
                                    $product = new Product();
                                    $product->head_id = $parent_product['id'];
                                    $product->sku = $item['sku'] ? $item['sku'] : $item['product_id'];
                                    $product->title = $item['title'];
                                    $product->selling_price = $item['price'];
                                    $product->cost_price = $item['price'];
                                    $product->save();
                                }
                                if ($item['variant_title']) {
                                    $ProductAttributeGroup = ProductAttributeGroup::where('title', $item['variant_title'])->first();
                                    if (!$ProductAttributeGroup) {
                                        $ProductAttributeGroup = new ProductAttributeGroup();
                                        $ProductAttributeGroup->title = $item['variant_title'];
                                        $ProductAttributeGroup->save();
                                    }
                                    $ProductAttributeValues = ProductAttributeValue::where('title', $item['variant_title'])
                                        ->where('group_id', $ProductAttributeGroup['id'])->first();
                                    if (!$ProductAttributeValues) {
                                        $ProductAttributeValues = new ProductAttributeValue();
                                        $ProductAttributeValues->title = $item['variant_title'];
                                        $ProductAttributeValues->group_id = $ProductAttributeGroup['id'];
                                        $ProductAttributeValues->save();
                                    }
                                    $product_variation = ProductAttribute::where('product_id', $product->id)
                                        ->where('group_id', $ProductAttributeGroup->id)
                                        ->where('value_id', $ProductAttributeValues->id)->first();
                                    if (!$product_variation) {
                                        $product_variation = new ProductAttribute();
                                        $product_variation->parent_product_id = $parent_product->id;
                                        $product_variation->product_id = $product->id;
                                        $product_variation->group_id = $ProductAttributeGroup->id;
                                        $product_variation->value_id = $ProductAttributeValues->id;
                                        $product_variation->save();
                                    }
                                }
//                                $product = Product::where('sku', $item['sku'] ? $item['sku'] : $item['product_id'])->whereNotNull('head_id')->first();

                                $items[$key]['qty'] = $item['quantity'];
                                $totalQuantity = $item['quantity'];
                                $items[$key]['product_id'] = $product['id'] ?? null;
                                $items[$key]['product_name'] = $product['name'] ?? null;
                                $items[$key]['sku'] = $product['sku'] ?? null;
                                $items[$key]['unit_price'] = $item['price'];
                            }
                            $order->quantity = $totalQuantity;
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
