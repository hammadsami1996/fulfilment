<?php

namespace App\Models;

use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use function Symfony\Component\Console\Style\text;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderViews extends Model
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes;
    use Search;
    use HasManyRelation;

    protected $columns = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'total', 'tax', 'balance', 'courier', 'payment_status', 'selling_Price',
        'location', 'sales_rep', 'selling_price', 'external_order_no', 'tracking_id', 'product_id', 'subTotal', 'discount', 'discount_percent',
        'shipped_by', 'quantity', 'order_type_id','delivery_charges'
    ];

    protected $search = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'total', 'tax', 'balance', 'courier', 'payment_status', '', 'selling_price',
        'location', 'sales_rep', 'selling_price', 'external_order_no', 'tracking_id', 'product_id', 'subTotal', 'discount', 'discount_percent',
        'shipped_by', 'quantity', 'order_type_id','delivery_charges'
    ];
    protected $appends = ['net_total','text'];
    public function getNetTotalAttribute()
    {
        return ($this->attributes['total'] + $this->attributes['shipping_charges'] - ($this->attributes['discount'] + $this->attributes['advance']));
    }
    public function getTextAttribute()
    {

    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Order_item::class, 'id', 'order_id');
    }

    public function wearhouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');

    }

    public function status()
    {
        return $this->belongsTo(Delivery_status::class, 'status_id', 'id');
    }

    public function shipped_by()
    {
        return $this->belongsTo(Courier::class, 'shipped_by_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function ordertype()
    {
        return $this->belongsTo(Order_type::class, 'order_type_id', 'id');
    }
}
