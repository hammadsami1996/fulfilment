<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Store;
use App\Models\Order;

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
                $this->storeOrder(1);
                // return response()->json($data);
            // return response()->json(['data' => true]);

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
    if (isset($store) && $store->plate_form == 'shopify') {
        // $apiUrl = $store->word_address . '/wp-json/wc/v3/orders';
        // $apiKey = $store->api_key;

        // // $apiSecret = 'cs_3895987df29107dcc5cd788b46bc6705f54f5f0c';
        // $apiSecret = $store->api_secret;

        $apiUrl = $store->store_address . '/admin/api/2023-07/orders.json?status=any';
        $headers = [
            'X-Shopify-Access-Token' => $store->access_token,
        ];
//            $apiUrl = "https://www.hamzastore.pk/account_services/get_orders?appkey=f5564407cc4ef468d1fe8a95570bcf8a&offset=100&pagination=1";
        try {
            $response = Http::withHeaders($headers)->get($apiUrl);
            if ($response->successful()) {
                $shopify = $response->json();
                // dd($shopify['orders']);
                foreach ($shopify['orders'] as $rec) {
                    // dd($rec['customer']['default_address']['address1']);
                    $order = Order::where('external_order_no', $rec['id'])->where('order_form','shopify');
                    if (!$order->first()) {
                        // dd('abcd');
                        $order = new Order();
                        $order->order_form = 'shopify';
                        $order->external_order_no = $rec['id'];
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



                        // other
                        // dd($rec['line_items ']);
                        $items = [];
                        foreach ($rec['line_items'] as $key => $item) {
                            // dd($item);
                            $items[$key]['qty'] = $item['quantity'];
                            // $items[$key]['value_inc_tax'] = $item['total'];
                            // $items[$key]['value_ex_tax'] = $item['subtotal'];

                            // $items[$key]['product_id'] = $item['product_id'];
                            $items[$key]['unit_price'] = $item['price'];
                            // $items[$key]['tax_amount'] = $item['total_tax'];



                            //other
                        }
                        $order->storeHasMany([
                            'items' => $items
                        ]);
                    }
                }
                return response()->json(['saved' => true]);

            } else {
                return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }
        } catch (Throwable $e) {
            return response()->json(['mimCart_error' => $e->getMessage()]);
        }
    }
}

}
