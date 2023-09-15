<?php

namespace App\Http\Controllers;

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

    public function storeOrder(Request $request)
    {
        $apiUrl = $request->mim_store_address . '/account_services/get_orders?appkey=' . $request->mim_api_key;
        try {
            $response = Http::get($apiUrl);
            if ($response->successful()) {
                $data = $response->json(); // No need to decode JSON manually
                
            } else {
                return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }
        } catch (Throwable $e) {
            return response()->json(['mimCart_error' => $e->getMessage()]);
        }
    }

}
