<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Order_item extends Model implements Auditable
{
    use HasFactory,Search, Notifiable, HasRoles,SoftDeletes,\OwenIt\Auditing\Auditable;
    

    protected $fillable = [
        'order_id', 'product_id', 'qty', 'unit_price', 'value_ex_tax', 'tax_percent', 'tax_amount', 'value_inc_tax', 'warehouse_id','product_sku','product_name','cost','discount_percent','discount_amount'
    ];
    protected $columns = [
        'order_id', 'product_id', 'qty', 'unit_price', 'value_ex_tax', 'tax_percent', 'tax_amount', 'value_inc_tax', 'warehouse_id','product_sku','product_name','cost','discount_percent','discount_amount'
    ];

    protected $search = [
        'order_id', 'product_id', 'qty', 'unit_price', 'value_ex_tax', 'tax_percent', 'tax_amount', 'value_inc_tax', 'warehouse_id','product_sku','product_name','cost','discount_percent','discount_amount'

    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['order_id'];
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
