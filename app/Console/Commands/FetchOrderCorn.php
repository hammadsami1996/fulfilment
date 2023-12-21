<?php

namespace App\Console\Commands;

use App\Http\Controllers\MimCartController;
use App\Http\Controllers\ShopifyController;
use App\Http\Controllers\WordpressController;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant; // Replace with the actual namespace and model name for your tenants model
use Illuminate\Console\Command;
//use Stancl\Tenancy\Contracts\Tenant;

class FetchOrderCorn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'fetchorder:corn';

    protected $signature = 'fetchOrderCorn';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $databases = Tenant::get();

        foreach ($databases as $database) {
            // Assuming $database->id is the identifier for the tenant
            $tenant = Tenant::find($database->id);

            if ($tenant) {
                tenancy()->initialize($tenant);
            }
//            dd($database->id);
//            tenancy()->init($database->id);

            $fetch = Store::where('store_type', 'Online')->where('fetch_order', true)->get();
//            $fetch = DB::table($database->id . ".store")->where('store_type', 'Online')->where('fetch_order', true)->get();
//            $fetch = DB::table("{$database->id}.store")->where('store_type', 'Online')->where('fetch_order', true)->get();
            if ($fetch->count() > 0) {
                foreach ($fetch as $store) {
                    if ($store->plate_form == "MimCart") {
                        $mimcart = new MimCartController();
                        $mimcart->storeOrder($store->id);
                    }
                    if ($store->plate_form == "WooCommerce") {
                        $woocommerce = new WordpressController();
                        $woocommerce->storeOrder($store->id);
                    }
                    if ($store->plate_form == "Shopify") {
                        $shopify = new ShopifyController();
                        $shopify->storeOrder($store->id);
                    }
                }
            }
        }
    }


//    public function handle()
//    {
//        $databases = Tenant::get();
//        foreach ($databases as $database) {
////        $fetch = Store::where('store_type', 'Online')->where('fetch_order', true)->get();
////            $fetch = DB::table($database->id . ".store")->where('store_type', 'Online')->where('fetch_order', true)->get();
//            $fetch = DB::table("`{$database->id}`.store")->where('store_type', 'Online')->where('fetch_order', true)->get();
//            if ($fetch->count() > 0) {
//                foreach ($fetch as $store) {
//                    if ($store->plate_form == "MimCart") {
//                        $mimcart = new MimCartController();
//                        $mimcart->storeOrder($store->id);
//                    }
//                    if ($store->plate_form == "WooCommerce") {
//                        $woocommerce = new WordpressController();
//                        $woocommerce->storeOrder($store->id);
//                    }
//                    if ($store->plate_form == "Shopify") {
//                        $shopify = new ShopifyController();
//                        $shopify->storeOrder($store->id);
//                    }
//                }
//            }
//        }
//    }



//    public function handle()
//    {
//        $fetch = Store::where('store_type', 'Online')->where('fetch_order', true)->get();
//        if ($fetch->count() > 0) {
//            foreach ($fetch as $store) {
//                if ($store->plate_form == "MimCart"){
//                    $mimcart = new MimCartController();
//                    $mimcart->storeOrder($store->id);
//                }
//                if ($store->plate_form == "WooCommerce"){
//                    $woocommerce = new WordpressController();
//                    $woocommerce->storeOrder($store->id);
//                }
//                if ($store->plate_form == "Shopify"){
//                    $shopify = new ShopifyController();
//                    $shopify->storeOrder($store->id);
//                }
//            }
//        }
//    }
}
