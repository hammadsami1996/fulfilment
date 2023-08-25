<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
   public function required(){

    $data = DB::select("SELECT
    p.title,
    p.product_sku,
    p.barcode,
    i.product_id,
    i.warehouse_id,
    SUM(oi.qty) AS ordered_qty,
    i.qty AS inventory_qty,
    pi.img AS product_image
FROM
    order_items oi
LEFT JOIN
    inventories i ON oi.product_id = i.product_id AND oi.warehouse_id = i.warehouse_id
LEFT JOIN
    products p ON i.product_id = p.id
LEFT JOIN
    (SELECT product_id, MIN(id) AS min_id FROM product_imgs GROUP BY product_id) img_min
    ON i.product_id = img_min.product_id
LEFT JOIN
    product_imgs pi ON img_min.min_id = pi.id
GROUP BY
    p.title, p.product_sku, p.barcode, i.product_id, i.warehouse_id, i.qty, pi.img
		HAVING
    SUM(oi.qty) > i.qty;
	

");

        return response()->json(['data' => ['data' => $data]]);

   } 
}
