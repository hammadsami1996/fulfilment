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
    $woocommerceApiUrl = 'https://wp.mimcart.com/wp-json/wc/v3/orders'; 
    $apiKey = 'ck_293766b75c5a707c5fb6638475880810a3c70a5a';
    $apiSecret = 'cs_3895987df29107dcc5cd788b46bc6705f54f5f0c';

    try {
        $response = Http::withBasicAuth($apiKey, $apiSecret)->get($woocommerceApiUrl);
        // dd($response->getBody());
        if ($response->successful()) {
            $orders = $response->json();
            // dd($orders);
            // Process and use $orders as needed
            return view('woocommerce.orders', compact('orders'));
        } else {
            // Handle API error response
            return view('woocommerce.error', ['message' => $response->body()]);
        }
    } catch (\Exception $e) {
        // Handle any other errors here
        return view('woocommerce.error', ['message' => $e->getMessage()]);
    }
}
}
