<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
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
                        $order = Order::where('external_order_no', $rec['id'])->where('order_form', 'WooCommerce');
                        if (!$order->first()) {
                            ++$i;
                            $order = new Order();
                            $order->order_form = 'WooCommerce';
                            $order->external_order_no = $rec['id'];
                            if ($rec['billing']['phone']) {
                                $customer = Customer::where('phone', $rec['billing']['phone'])->first();
                                if ($customer) {
                                    $order->customer_id = $customer['id'];
                                } else {
                                    $customer = new Customer();
                                    $customer->name = $rec['billing']['first_name'];
                                    $customer->address = $rec['shipping']['address_1'] . $rec['shipping']['address_2'];

                                    $customer->email = $rec['billing']['email'];
                                    $customer->phone = $rec['billing']['phone'];

                                    $b_city = City::where('name', $rec['billing']['city'])->first();

                                    $customer->b_city_id = $b_city['id'];
                                    $customer->b_country_id = $b_city['country_id'];
                                    $customer->b_name = $rec['billing']['first_name'];
                                    $customer->b_phone = $rec['billing']['phone'];
                                    $customer->b_address_1 = $rec['billing']['address_1'];
                                    $customer->b_address_2 = $rec['billing']['address_2'];
                                    
                                    if ($rec['shipping']) {
                                        $s_city = City::where('name', $rec['shipping']['city'])->first();
                                        if ($s_city) {
                                            $customer->s_city_id = $s_city['id'];
                                            $customer->s_country_id = $s_city['country_id'];
                                        }
                                    }
                                    $customer->s_name = $rec['shipping']['first_name'];
                                    $customer->s_phone = $rec['shipping']['phone'];
                                    $customer->s_address_1 = $rec['shipping']['address_1'];
                                    $customer->s_address_2 = $rec['shipping']['address_2'];
                                    $customer->save();
                                    $order->customer_id = $customer['id'];
                                }
                            }
                            $order->name = $rec['billing']['first_name'];
                            $order->email = $rec['billing']['email'];
                            $order->phone = $rec['billing']['phone'];
                            $order->address = $rec['billing']['address_1'] . $rec['billing']['address_2'];
                            $order->store_id = $id;
                            $order->shipping_charges = $rec['shipping_tax'];
                            $order->total = $rec['total'];
                            $order->discount = $rec['discount_total'];
                            // $order->customer_id = $rec['customer_id'];
                            $order->tracking_id = $rec['cart_hash'];
                            $order->payment_method = $rec['payment_method_title'];

                            $order->status_id = 1;

                            $items = [];
                            foreach ($rec['line_items'] as $key => $item) {
                                // dd($item);
                                $product = Product::where('product_sku', $item['sku'])->first();
                                if (!$product) {
                                    $product = new Product();
                                    $product->product_sku = $item['sku'];
                                    $product->title = $item['name'];
                                    $product->selling_price = $item['price'];
                                    $product->cost_price = $item['price'];
                                    $product->save();
                                }
                                $items[$key]['qty'] = $item['quantity'];
                                $items[$key]['value_inc_tax'] = $item['total'];
                                $items[$key]['value_ex_tax'] = $item['subtotal'];

                                $items[$key]['product_id'] = $product['id'];
                                $items[$key]['unit_price'] = $item['price'];
                                $items[$key]['tax_amount'] = $item['total_tax'];
                            }
                            $order->storeHasMany([
                                'items' => $items
                            ]);
                        }
                    }
                    return response()->json(['saved' => true,'new'=>$i]);
                } else {
                    return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
                }
            } catch (Throwable $e) {
                return response()->json(['woo_commerce_error' => $e->getMessage()]);
            }
        }
    }
}
