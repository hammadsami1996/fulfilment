<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Store;
use App\Models\Order;

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
            // return response()->json(['data' => true]);
            
            return response()->json(['data' => $orders]);

            // return view('woocommerce.orders', compact('orders'));
        } else {
            // Handle API error response
            return response()->json(['error' => true]);
            // return view('woocommerce.error', ['message' => $response->body()]);
        }
    }
    catch (\Exception $e) {
       
        return response()->json(['woocommerce_error'=> $e->getMessage()]);
    }
}


public function store_order(){
    $woocommerceApiUrl = 'https://wp.mimcart.com/wp-json/wc/v3/orders';

    $apiKey = 'ck_293766b75c5a707c5fb6638475880810a3c70a5a';
  

    $apiSecret = 'cs_3895987df29107dcc5cd788b46bc6705f54f5f0c';
    $apiSecret = request()->api_secret;


    try {
        $response = Http::withBasicAuth($apiKey, $apiSecret)->get($woocommerceApiUrl);
       
       
            $orders = $response->json();
          
            
            dd($orders);

            
     
            
           
      
    } catch (\Exception $e) {
       
        return response()->json(['woocommerce_error'=> $e->getMessage()]);
    }
}


public function storeOrder($id)
{
    $store = Store::findOrFail($id);
    if (isset($store) && $store->plate_form == 'woocommerce') {
        $apiUrl = $store->word_address . '/wp-json/wc/v3/orders';
        $apiKey = $store->api_key;

        // $apiSecret = 'cs_3895987df29107dcc5cd788b46bc6705f54f5f0c';
        $apiSecret = $store->api_secret;
//            $apiUrl = "https://www.hamzastore.pk/account_services/get_orders?appkey=f5564407cc4ef468d1fe8a95570bcf8a&offset=100&pagination=1";
        try {
            $response = Http::withBasicAuth($apiKey, $apiSecret)->get($apiUrl);
            if ($response->successful()) {
                foreach ($response->json() as $rec) {
                    $order = Order::where('external_order_no', $rec['id'])->where('order_form','woocommerce');
                    if (!$order->first()) {
                        $order = new Order();
                        $order->order_form = 'woocommerce';
                        $order->external_order_no = $rec['id'];
                        $order->name = $rec['billing']['first_name'];
                        $order->email = $rec['billing']['email'];
                        $order->phone = $rec['billing']['phone'];
                        $order->address = $rec['billing']['phone'];
                        $order->address = $rec['shipping_total'];
                        $order->total = $rec['total'];
                        $order->discount = $rec['discount_total'];
                        $order->customer_id = $rec['customer_id'];


                        

                        $order->status_id = 1;



                        // other
                        $items = [];
                        foreach ($rec['items'] as $key => $item) {
                            $items[$key]['qty'] = $item['qty'];
                            $items[$key]['value_inc_tax'] = $item['total'];
                            $items[$key]['value_ex_tax'] = $item['subtotal'];

                            $items[$key]['product_id'] = $item['product_id'];
                            $items[$key]['unit_price'] = $item['price'];
                            $items[$key]['tax_amount'] = $item['total_tax'];



                            //other
                        }
                        $order->storeHasMany([
                            'items' => $items
                        ]);
                    }
                }
            } else {
                return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }
        } catch (Throwable $e) {
            return response()->json(['mimCart_error' => $e->getMessage()]);
        }
    }
}
}
