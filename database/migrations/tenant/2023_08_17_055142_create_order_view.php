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
        $sql = "select `o`.*,(case when (`p`.`manage_inventory` = 0) then 'packable' when exists(select 1 from (`order_items` `oi` left join `inventories` `i` on(((`oi`.`product_id` = `i`.`product_id`) and (`o`.`warehouse_id` = `i`.`warehouse_id`)))) where ((`oi`.`order_id` = `o`.`id`) and (`oi`.`qty` > coalesce(`i`.`qty`,0)))) then 'unpackable' else 'packable' end) AS `packability` from ((`orders` `o` left join `order_items` `oi` on((`o`.`id` = `oi`.`order_id`))) left join `products` `p` on((`oi`.`product_id` = `p`.`id`))) where (`o`.`deleted_at` is null)"

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
