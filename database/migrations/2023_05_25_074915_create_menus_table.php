<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('route')->nullable();
            $table->integer('head_id')->nullable();
            $table->string('guard');
            $table->integer('icon')->nullable();
            $table->integer('sort')->nullable();
            $table->timestamps();
        });


        DB::table('menus')->insert(
            [
                'title' => 'Setup',
                'url' => '',
                'route' => '',
                'guard' => '',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Purchase',
                'url' => '',
                'route' => '',
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Orders Management',
                'url' => '',
                'route' => '',
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Sales',
                'url' => '',
                'route' => '',
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Ledgers',
                'url' => '',
                'route' => '',
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Settings',
                'url' => '',
                'route' => '',
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'User',
                'url' => '/user',
                'route' => 'view-user',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Role',
                'url' => '/role',
                'route' => 'view-role',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Permission',
                'url' => '/permission',
                'route' => 'view-permission',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Company',
                'url' => '/company',
                'route' => 'view-company',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Stores',
                'url' => '/stores',
                'route' => 'view-stores',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Warehouse',
                'url' => '/warehouse',
                'route' => 'view-warehouse',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Customer',
                'url' => '/customer',
                'route' => 'view-customer',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'User Subscription',
                'url' => '/user_subscription',
                'route' => 'view-user_subscription',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'User Dashboard',
                'url' => '/user_dashboard',
                'route' => 'view-user_dashboard',
                'head_id' => 1,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Product Category',
                'url' => '/product_category',
                'route' => 'view-product_category',
                'head_id' => 2,
                'guard' => 'web',
            ]
        );
          
        DB::table('menus')->insert(
            [
                'title' => 'Brand',
                'url' => '/brand',
                'route' => 'view-brand',
                'head_id' => 2,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Suppliers',
                'url' => '/supplier',
                'route' => 'view-supplier',
                'head_id' => 2,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Product',
                'url' => '/product',
                'route' => 'view-product',
                'head_id' => 2,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Purchase',
                'url' => '/purchase',
                'route' => 'view-purchase',
                'head_id' => 2,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Inventory',
                'url' => '/inventory',
                'route' => 'view-inventory',
                'head_id' => 2,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Order',
                'url' => '/order',
                'route' => 'view-order',
                'head_id' => 3,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Receive Order',
                'url' => '/receive_order',
                'route' => 'view-receive_order',
                'head_id' => 3,
                'guard' => 'web',
            ]
        );
     
        DB::table('menus')->insert(
            [
                'title' => 'Place Replacement Order',
                'url' => '/replacement',
                'route' => 'view-replacement',
                'head_id' => 3,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Required Item Stock',
                'url' => '/required_item_stock',
                'route' => 'view-required_item_stock',
                'head_id' => 3,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Fetch Order',
                'url' => '/fetch_order',
                'route' => 'view-fetch_order',
                'head_id' => 3,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Chart of Accounts',
                'url' => '/coa',
                'route' => 'view-chart_of_accounts',
                'head_id' => 5,
                'guard' => 'web',
            ]
        );
        DB::table('menus')->insert(
            [
                'title' => 'Global Settings',
                'url' => '/global_settings',
                'route' => 'view-global_settings ',
                'head_id' => 6,
                'guard' => 'web',
            ]
        );
        // DB::unprepared(file_get_contents(public_path('/menus.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
