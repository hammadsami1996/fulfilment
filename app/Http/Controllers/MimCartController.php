<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MimCartController extends Controller
{
    public function fetchData(Request $request)
    {
//        dd($request->all());
        $apiUrl = $request->mim_store_address . '/account_services/get_orders?appkey=' . $request->mim_api_key;
//        $headers = [
//            'f5564407cc4ef468d1fe8a95570bcf8a' => $request-> mim_api_key,
//        ];
        try {
            // Make the HTTP GET request with headers using the Http facade
            $response = Http::get($apiUrl);
            // Check if the request was successful
            if ($response->successful()) {
                $data = $response->json(); // No need to decode JSON manually
                return response()->json($data);
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
//            $apiUrl = "https://www.hamzastore.pk/account_services/get_orders?appkey=f5564407cc4ef468d1fe8a95570bcf8a&offset=100&pagination=1";
            try {
                $response = Http::get($apiUrl);
                if ($response->successful()) {
                    foreach ($response->json() as $rec) {
//                        dd($rec);
                        $order = Order::where('external_order_no', $rec['id'])->where('order_form','MimCart');
                        if (!$order->first()) {
                            $order = new Order();
                            $order->order_form = 'MimCart';
                            $order->external_order_no = $rec['id'];
                            $order->name = $rec['name'];
                            $order->customer_id = $rec['name'];
                            $order->email = $rec['email'];
                            $order->phone = $rec['mobile'];
                            $order->s_addres_1 = $rec['address'];
                            $order->instraction = $rec['instructions'];
                            $order->city_id = $rec['city'];
//                            $order->status_id = $rec['status_id'];
//                            $order->payment_method = $rec['payment_method'];
                            $order->shipping_charges = $rec['shipping_charges'];
                            // other
                            $items = [];
                            foreach ($rec['items'] as $key => $item) {
                                $items[$key]['name'] = $item['title'];
                                $items[$key]['qty'] = $item['qty'];
                                $items[$key]['value_inc_tax'] = $item['total'];
                                $items[$key]['unit_price'] = $item['price'];
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
