<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopifyController extends Controller
{
    public function fetchData(Request $request)
    {
//        dd($request->all());
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
                return response()->json($data);
            } else {
                // Handle the error, e.g., log it or return an error response
                return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
            }
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

}
