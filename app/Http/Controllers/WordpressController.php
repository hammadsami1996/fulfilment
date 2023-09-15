<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
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
            // return response()->json(['data' => true]);
            
            return response()->json(['data' => $orders]);

            // return view('woocommerce.orders', compact('orders'));
        } else {
            // Handle API error response
            return response()->json(['error' => true]);
            // return view('woocommerce.error', ['message' => $response->body()]);
        }
    } catch (\Exception $e) {
        // Handle any other errors here
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
}
