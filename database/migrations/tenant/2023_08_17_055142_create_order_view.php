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
        $sql = "select `o`.*,(case when exists(select 1 from ((`order_items` `oi` left join `products` `p` on((`p`.`id` = `oi`.`product_id`))) left join `inventories` `i` on(((`oi`.`product_id` = `i`.`product_id`) and (`o`.`warehouse_id` = `i`.`warehouse_id`)))) where ((`oi`.`order_id` = `o`.`id`) and (`oi`.`qty` > coalesce(`i`.`qty`,0)) and (`p`.`manage_inventory` = 1))) then 'unpackable' else 'packable' end) AS `packability` from `orders` `o` where (`o`.`deleted_at` is null)";

        DB::statement($sql);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS order_views');
    }
};
