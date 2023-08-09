<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receive_order_item extends Model
{
    use HasFactory;


    protected $table = 'receive_order_items';

    protected $fillable = [
        'product_id', 'purchase_order_item_id', 'qty','unit_price','tax_percent','value_ex_tax','value_inc_tax'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function PurchaseOrderItem()
    {
        return $this->belongsTo(PurchaseOrderItem::class, 'purchase_order_item_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(ReceiveOrder::class, 'receive_order_id', 'id');
    }
}
