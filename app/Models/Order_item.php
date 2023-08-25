<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Order_item extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
   'order_id', 'product_id','qty', 'unit_price', 'value_ex_tax','tax_percent', 'tax_amount', 'value_inc_tax' ,'warehouse_id'
    ];
    protected $columns = [
        'order_id', 'product_id','qty', 'unit_price', 'value_ex_tax','tax_percent', 'tax_amount', 'value_inc_tax','warehouse_id'

    ];

    protected $search = [
        'order_id', 'product_id','qty', 'unit_price', 'value_ex_tax','tax_percent', 'tax_amount', 'value_inc_tax' ,'warehouse_id'

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
