<?php

namespace App\Http\Controllers;

use App\Models\CourierResponse;
use App\Models\OrderViews;
use Illuminate\Support\Facades\Http;

class ShipmentController extends Controller
{
    function generateCN($id)
    {
        $order = OrderViews::with('courier', 'city')->findOrfail($id);
        $courier = $order->courier ? $order->courier->name : false;
        $res = false;
        if ($courier) {
            if ($courier == 'Trax Saverplus') {
                $res = $this->trax($order);
            }
        }
        dd($res);
        return response()->json(['data' => $order]);
    }

    function trax($order, $service = "1")
    {
        $output = 0;

        $url = "https://sonic.pk/api/shipment/book";
        $fieldNames = [
            'service_type_id',
            'pickup_address_id',
            'information_display',
            'consignee_city_id',
            'consignee_name',
            'consignee_address',
            'consignee_phone_number_1',
            'consignee_email_address',
            'order_id',
            'item_product_type_id',
            'item_description',
            'item_quantity',
            'item_insurance',
            'item_price',
            'pickup_date',
            'special_instructions',
            'estimated_weight',
            'shipping_mode_id',
            'amount',
            'payment_mode_id',
        ];
        $data = [
            'service_type_id' => $service,
            'pickup_address_id' => 31816,
            'information_display' => '1',
            'consignee_city_id' => $order->city->trax->id,
            'consignee_name' => $order->s_name,
            'consignee_address' => $order->s_address_1,
            'consignee_phone_number_1' => $order->s_phone,
            'consignee_email_address' => $order->s_email ?? '',
            'order_id' => $order->id,
            'item_product_type_id' => '22',
            'item_description' => empty($order->item_summary_mannual) ? $order->item_summary : $order->item_summary_mannual,
            'item_quantity' => $order->quantity ?? 1,
            'item_insurance' => '0',
            'item_price' => $order->net_total,
            'pickup_date' => now()->format('Y-m-d'),
            'special_instructions' => !empty($order->instructions) ? $order->instructions : 'No',
            'estimated_weight' => '0.5',
            'shipping_mode_id' => '1',
            'amount' => $order->net_total,
            'payment_mode_id' => '1',
        ];
        $requestData = $this->buildRequestArray($fieldNames, $data);
        dd($requestData);
        $response = Http::withHeaders(['Authorization' => 'TUVEZkRzaHdCYkpIWEtWTGxyNG44UFhOMGhFenk4T1pUWjI5V3VkQ0FYV08xajVXYXlid1dvZ1lRUVlD608fd2e735113'])->post($url,$requestData);

        $result = $response->json();
        if (isset($result['errors'])) {
            $output = json_encode($result['errors']);
        }
//            elseif (isset($result['message']) && $result['status'] == 1) {
//                $output = $result['message'];
//            }
        else {
            if (isset($result['message'])){
                $c = CourierResponse::where('')->first();

            }
            $output = $response->json();
        }

        return $output;
    }

    function buildRequestArray($fieldNames, $data)
    {
        $requestData = [];

        foreach ($fieldNames as $fieldName) {
            // Check if the field exists and is not empty or null
            if (isset($data[$fieldName]) && !empty($data[$fieldName])) {
                $requestData[$fieldName] = $data[$fieldName];
            }
        }

        return $requestData;
    }
}
