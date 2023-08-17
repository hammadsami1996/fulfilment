<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        Schema::create('order_views', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
//        });
        $sql = "
        CREATE VIEW order_views AS
        SELECT o.*,
               CASE
                   WHEN EXISTS (
                       SELECT 1
                       FROM order_items oi
                       LEFT JOIN inventories i ON oi.product_id = i.product_id AND o.warehouse_id = i.warehouse_id
                       WHERE oi.order_id = o.id AND oi.qty > COALESCE(i.qty, 0)
                   ) THEN 'unpackable'
                   ELSE 'packable'
               END AS packability
        FROM orders o;
        ";

        DB::statement($sql);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('_order_view');
        DB::statement('DROP VIEW IF EXISTS order_views');

    }
};
