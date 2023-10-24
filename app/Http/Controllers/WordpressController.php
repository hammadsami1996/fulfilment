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
use Illuminate\Support\Facades\Http;


class WordpressController extends Controller
{
    // public function getWordpressPosts(Request $request)
    // {
    //     $wordpressApiUrl = 'https://wp.mimcart.com/wp-json/wp/v2/posts'; // Replace with your WordPress API URL

    //     $client = new Client();

    //     try {
    //         $response = $client->request('GET', $wordpressApiUrl);
    //                 dd($response);
    //         if ($response->getStatusCode() === 200) {
    //             $posts = json_decode($response->getBody());
    //             return view('wordpress.posts', ['posts' => $posts]);
    //         }
    //     } catch (\Exception $e) {

    //         return view('wordpress.error');
    //     }
    // }

    public function getWooCommerceOrders()
    {
        // dd(request()->all());
        // dd(request()->api_secret);
        // $woocommerceApiUrl = 'https://wp.mimcart.com/wp-json/wc/v3/orders';
        $woocommerceApiUrl = request()->word_address . '/wp-json/wc/v3/orders';

        // $apiKey = 'ck_293766b75c5a707c5fb6638475880810a3c70a5a';
        $apiKey = request()->api_key;

        // $apiSecret = 'cs_3895987df29107dcc5cd788b46bc6705f54f5f0c';
        $apiSecret = request()->api_secret;


        try {
            $response = Http::withBasicAuth($apiKey, $apiSecret)->get($woocommerceApiUrl);
            // dd($response->getBody());
            if ($response->successful()) {
                $orders = $response->json();
                // dd($orders);
                // Process and use $orders as needed
                return response()->json(['data' => true]);
                // $this->storeOrder(1);
                // return response()->json(['data' => $orders]);

                // return view('woocommerce.orders', compact('orders'));
            } else {
                // Handle API error response
                return response()->json(['error' => true]);
                // return view('woocommerce.error', ['message' => $response->body()]);
            }
        } catch (\Exception $e) {

            return response()->json(['woocommerce_error' => $e->getMessage()]);
        }
    }


// public function store_order(){
//     $woocommerceApiUrl = 'https://wp.mimcart.com/wp-json/wc/v3/orders';

//     $apiKey = 'ck_293766b75c5a707c5fb6638475880810a3c70a5a';


//     $apiSecret = 'cs_3895987df29107dcc5cd788b46bc6705f54f5f0c';
//     $apiSecret = request()->api_secret;


//     try {
//         $response = Http::withBasicAuth($apiKey, $apiSecret)->get($woocommerceApiUrl);


//             $orders = $response->json();


//             dd($orders);


//     } catch (\Exception $e) {

//         return response()->json(['woocommerce_error'=> $e->getMessage()]);
//     }
// }


    public function storeOrder($id)
    {
        $store = Store::findOrFail($id);
        if (isset($store) && $store->plate_form == 'WooCommerce') {
            $apiUrl = $store->word_address . '/wp-json/wc/v3/orders';
            $apiKey = $store->api_key;
            $apiSecret = $store->api_secret;
            try {

                $response = Http::withBasicAuth($apiKey, $apiSecret)->get($apiUrl);
                if ($response->successful()) {
                    $i = 0;

                    foreach ($response->json() as $rec) {
                        // dd($rec);

                        $order = Order::where('external_order_no', $rec['id'])->where('order_form', 'WooCommerce')->where('store_id', $store->id)->first();
                        if (!$order) {
                            ++$i;
                            $order = new Order();
                            $order->store_id = $id;
                            $order->warehouse_id = $store['warehouse_id'];
                            $order->company_id = $store['company_id'];
                            $order->order_form = 'WooCommerce';
                            $order->external_order_no = $rec['id'];
                            if ($rec['billing']['phone']) {
                                $customer = Customer::where('phone', $rec['billing']['phone'])->first();
                                if ($customer) {
                                    $order->customer_id = $customer['id'];
                                } else {
                                    $customer = new Customer();
                                    $customer->name = $rec['billing']['first_name'] . ' ' . $rec['billing']['last_name'];
                                    $customer->email = $rec['billing']['email'];
                                    $customer->phone = $rec['billing']['phone'];


                                    if ($rec['billing']) {
                                        $b_city = City::where('name', $rec['billing']['city'])->first();
                                        if ($b_city) {
                                            $customer->b_city_id = $b_city['id'];
                                            $customer->b_country_id = $b_city['country_id'];
                                        }
                                        $order->b_name = $rec['billing']['first_name'] . ' ' . $rec['billing']['last_name'];
                                        $order->b_phone = $rec['billing']['phone'];
                                        $order->b_address_1 = $rec['billing']['address_1'] . ' ' . $rec['billing']['address_2'];
                                    }
                                    $customer->b_name = $rec['billing']['first_name'] . $rec['billing']['last_name'];
                                    $customer->b_phone = $rec['billing']['phone'];
                                    $customer->b_address_1 = $rec['billing']['address_1'] . ' ' . $rec['billing']['address_2'];
                                    if ($rec['shipping']) {
                                        $s_city = City::where('name', $rec['shipping']['city'])->first();
                                        if ($s_city) {
                                            $customer->s_city_id = $s_city['id'];
                                            $customer->s_country_id = $s_city['country_id'];
                                        }
                                        $customer->s_name = $rec['shipping']['first_name'] . ' ' . $rec['shipping']['last_name'];
                                        $customer->s_phone = $rec['shipping']['phone'];
                                        $customer->s_address_1 = $rec['shipping']['address_1'] . ' ' . $rec['shipping']['address_2'];
                                    }
                                    $customer->save();
                                    $order->customer_id = $customer['id'];
                                }
                            }

                            $order->b_name = $rec['billing']['first_name'] . ' ' . $rec['billing']['last_name'];
                            $order->b_phone = $rec['billing']['phone'];
                            $order->b_email = $rec['billing']['email'];
                            $order->b_address_1 = $rec['billing']['address_1'] . ' ' . $rec['billing']['address_2'];

                            $order->s_name = $rec['shipping']['first_name'] . ' ' . $rec['shipping']['last_name'];
                            $order->s_phone = $rec['shipping']['phone'];
                            $order->s_email = $rec['billing']['email'];
                            $order->s_address_1 = $rec['shipping']['address_1'] . ' ' . $rec['shipping']['address_2'];

                            $order->shipping_charges = $rec['shipping_tax'];
                            $order->total = $rec['total'];
                            $order->discount = $rec['discount_total'];

                            $cities = City::where('name', $rec['billing']['city'])->first();
                            if ($cities) {
                                $order->city_id = $cities->id;
                                $cityCourier = City_Courier::where('city_id', $cities->id)->first();
                                if ($cityCourier) {
                                    $order->courier_id = $cityCourier->courier_id;
//                                    $order->delivery_charges = $cityCourier->delivery_charges;
                                }
                            }
                            $order->tracking_id = $rec['cart_hash'];
                            $order->payment_method = $rec['payment_method_title'];
                            $order->so_number = $rec['number'];
                            $order->comments = $rec['customer_note'];
                            $order->currency_symbol = $rec['currency'];
                            $order->city_name = $rec['billing']['city'];
                            $order->location = $rec['billing']['address_1']. ' ' . $rec['billing']['last_name'];
                           

                            $order->status_id = 1;

                            $items = [];
                            $sum = '';
                            $quantity = 0;

                            foreach ($rec['line_items'] as $key => $item) {
                                $parent_product = Product::where('title', $item['parent_name'])->whereNull('head_id')->first();
                                if (!$parent_product) {
                                    $parent_product = new Product();
                                    $parent_product->title = $item['parent_name'];
                                    $parent_product->product_types = 1;
                                    $parent_product->selling_price = $item['price'];
                                    $parent_product->cost_price = $item['price'];
                                    $parent_product->save();
                                }
                                $product = Product::where('sku', $item['sku'] ? $item['sku'] : $item['product_id'])->whereNotNull('head_id')->first();

                                if (!$product) {
                                    $product = new Product();
                                    $product->head_id = $parent_product['id'];
                                    $product->sku = $item['sku'] ? $item['sku'] : $item['product_id'];
                                    $product->title = $item['name'];
                                    $product->selling_price = $item['price'];
                                    $product->cost_price = $item['price'];
                                    $product->save();
                                }
//                                $itemVariations = [];
                                foreach ($item['meta_data'] as $key1 => $itemV) {
                                    $ProductAttributeGroup = ProductAttributeGroup::where('title', $itemV['display_key'])->first();
                                    if (!$ProductAttributeGroup) {
                                        $ProductAttributeGroup = new ProductAttributeGroup();
                                        $ProductAttributeGroup->title = $itemV['display_key'];
                                        $ProductAttributeGroup->save();
                                    }
                                    $ProductAttributeValues = ProductAttributeValue::where('title', $itemV['display_value'])
                                        ->where('group_id', $ProductAttributeGroup['id'])->first();
                                    if (!$ProductAttributeValues) {
                                        $ProductAttributeValues = new ProductAttributeValue();
                                        $ProductAttributeValues->title = $itemV['display_value'];
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
                                $items[$key]['qty'] = $item['quantity'];
                                $items[$key]['value_inc_tax'] = $item['total'];
                                $items[$key]['value_ex_tax'] = $item['subtotal'];
                                $items[$key]['product_id'] = $product['id'];
                                $items[$key]['unit_price'] = $item['price'];
                                $items[$key]['tax_amount'] = $item['total_tax'];
                                $sum .= $item['name'] . " (Qty:" . $item['quantity'] . ")\n";
                                $quantity = $quantity + (int)$item['quantity'];
                            }
                            $order['item_summary'] = $sum;
                            $order['quantity'] = $quantity;
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
                return response()->json(['woo_commerce_error' => $e->getMessage()]);
            }
        }
    }
}
