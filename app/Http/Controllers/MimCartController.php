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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MimCartController extends Controller
{
    public function fetchData(Request $request)
    {
        $apiUrl = $request->mim_store_address . '/account_services/get_orders?appkey=' . $request->mim_api_key;
        try {
            // Make the HTTP GET request with headers using the Http facade
            $response = Http::get($apiUrl);
            // Check if the request was successful
            if ($response->successful()) {
                $data = $response->json(); // No need to decode JSON manually
                // return response()->json($data);
                return response()->json(['data' => true]);
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
        $orderLastTimes = Order::where('store_id', $id)
            ->orderBy('order_date', 'desc')
            ->first();
        if (isset($store) && $store->plate_form == 'MimCart') {
            if ($orderLastTimes) {
                $apiUrl = $store->mim_store_address . '/account_services/get_orders?appkey=' . $store->mim_api_key . '&last_orderon=' . $orderLastTimes->order_date;
            } else {
                $apiUrl = $store->mim_store_address . '/account_services/get_orders?appkey=' . $store->mim_api_key;
            }
//            $apiUrl = $store->mim_store_address . '/account_services/get_orders?appkey=' . $store->mim_api_key.'&id=94144';
            try {
                $response = Http::get($apiUrl);
                // dd($response);
                if ($response->successful()) {
                    $i = 0;
                    // dd($response->json());
                    foreach ($response->json() as $rec) {
                        if (isset($rec['id'])) {
                            $order = Order::where('external_order_no', $rec['id'])->where('order_form', 'MimCart')->where('store_id', $store->id)->first();
                            if (!$order) {
                                ++$i;
                                $order = new Order();
                                $order->store_id = $store->id;
                                $order->company_id = $store->company_id;
                                $order->order_date = $store->createdon;
                                $order->warehouse_id = $store->warehouse_id;
                                $order->order_form = 'MimCart';
                                $order->external_order_no = $rec['id'];
                                // $order->name = $rec['name'];
                                if ($rec['mobile']) {
                                    $customer = Customer::where('phone', $rec['mobile'])->first();
                                    if ($customer) {
                                        $order->customer_id = $customer['id'];
                                    } else {
                                        $customer = new Customer();
                                        $customer->name = $rec['name'];
                                        $customer->email = $rec['email'];
                                        $customer->phone = $rec['mobile'];

                                        $customer->b_name = $rec['name'];
                                        $customer->b_phone = $rec['mobile'];
                                        $customer->b_address_1 = $rec['address'];
                                        $b_city = City::where('name', $rec['city'])->first();
                                        if ($b_city) {
                                            $customer->b_city_id = $b_city['id'];
                                            $customer->b_country_id = $b_city['country_id'];
                                            $customer->s_city_id = $b_city['id'];
                                            $customer->s_country_id = $b_city['country_id'];
                                        }
                                        $customer->s_name = $rec['name'];
                                        $customer->s_phone = $rec['mobile'];
                                        $customer->s_address_1 = $rec['address'];
                                        $customer->save();
                                        $order->customer_id = $customer['id'];
                                    }
                                }

                                $order->b_name = $rec['name'];
                                $order->b_phone = $rec['mobile'];
                                $order->b_email = $rec['email'];
                                $order->b_address_1 = $rec['address'];

                                $order->s_name = $rec['name'];
                                $order->s_phone = $rec['mobile'];
                                $order->s_email = $rec['email'];
                                $order->s_address_1 = $rec['address'];

                                $s_city = City::where('name', $rec['city'])->first();
                                if ($s_city) {
                                    $order->city_id = $s_city->id;
                                    $cityCourier = City_Courier::where('city_id', $s_city->id)->first();
                                    if ($cityCourier) {
                                        $order->courier_id = $cityCourier->courier_id;
                                    }
                                }

                                $order->instructions = $rec['instructions'];
                                $order->comments = $rec['comments'];
                                $order->payment_method = $rec['payment_method'];
                                $order->total = $rec['total'];
                                $order->discount = $rec['discount'];
                                $order->advance = $rec['advance'];
                                $order->redeem_amount = $rec['redeem_amount'];
                                $order->coupons_discount = $rec['coupons_discount'];
                                $order->coupons = $rec['coupons'];
                                $order->net_total = $rec['net_total'];
                                $order->order_date = $rec['createdon'];
                                $order->location = $rec['address'];
                                $order->city_name = $rec['city'];
                                $order->shipment_services = $rec['shipment_services'] || null;
                                $order->store_id = $id;
                                $order->shipping_charges = $rec['shipping_charges'];
                                $items = [];
                                $sum = '';
                                $quantity = 0;
                                foreach ($rec['items'] as $key => $item) {
                                    $parent_product = Product::where('title', $item['product_name'])->whereNull('head_id')->first();
                                    if (!$parent_product) {
                                        $parent_product = new Product();
                                        $parent_product->title = $item['product_name'];
                                        $parent_product->product_types = 1;
                                        $parent_product->selling_price = $item['unit_price'];
                                        $parent_product->cost_price = $item['cost'];
                                        $parent_product->save();
                                    }
                                    $product = Product::where('sku', $item['sku'] ? $item['sku'] : $item['product_id'])->whereNotNull('head_id')->first();

                                    if (!$product) {
                                        $product = new Product();
                                        $product->head_id = $parent_product['id'];
                                        $product->sku = $item['sku'] ? $item['sku'] : $item['product_id'];
                                        $product->title = $item['product_name'];
                                        $product->selling_price = $item['unit_price'];
                                        $product->cost_price = $item['cost'];
                                        $product->save();
                                    }
                                    foreach ($item['options'] as $key1 => $itemV) {
                                        $ProductAttributeGroup = ProductAttributeGroup::where('title', $itemV['groups_title'])->first();
                                        if (!$ProductAttributeGroup) {
                                            $ProductAttributeGroup = new ProductAttributeGroup();
                                            $ProductAttributeGroup->title = $itemV['groups_title'];
                                            $ProductAttributeGroup->save();
                                        }
                                        $ProductAttributeValues = ProductAttributeValue::where('title', $itemV['value_title'])
                                            ->where('group_id', $ProductAttributeGroup['id'])->first();
                                        if (!$ProductAttributeValues) {
                                            $ProductAttributeValues = new ProductAttributeValue();
                                            $ProductAttributeValues->title = $itemV['value_title'];
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

                                    $items[$key]['product_id'] = $product['id'];
                                    // $items[$key]['title'] = $item['title'];
                                    $items[$key]['product_name'] = $item['product_name'] ?? null;
                                    $items[$key]['sku'] = $item['sku'];
                                    $items[$key]['order_id'] = $item['order_id'];
                                    $items[$key]['qty'] = $item['qty'];
                                    $items[$key]['value_inc_tax'] = $item['value_inc_tax'] || null;
                                    $items[$key]['warehouse_id'] = $item['warehouse_id'];
                                    $items[$key]['tax_amount'] = $item['tax_amount'] || null;
                                    $items[$key]['tax_percent'] = $item['tax_percent'] || null;
                                    $items[$key]['unit_price'] = $item['unit_price'];
                                    $items[$key]['coupon_discount'] = $item['coupon_discount'];
                                    $items[$key]['discount'] = $item['discount'];
                                    $items[$key]['cost'] = $item['cost'] || 0;
                                    $items[$key]['total'] = $item['total'];
                                    $sum .= $item['product_name'] . " (Qty:" . $item['qty'] . ")\n";
                                    $quantity = $quantity + (int)$item['qty'];
                                }
                                $order['item_summary'] = $sum;
                                $order['quantity'] = $quantity;
                                $order->storeHasMany([
                                    'items' => $items
                                ]);
                            }
                        }
                    }
                    return response()->json(['saved' => true, 'new' => $i]);
                } else {
                    return response()->json(['error' => 'Failed to fetch data from the API'], $response->status());
                }
            } catch (Throwable $e) {
                return response()->json(['mimCart_error' => $e->getMessage()]);
            }
        }
    }
}
