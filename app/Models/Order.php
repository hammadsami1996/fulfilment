<?php

namespace App\Models;

use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes;
    use Search;
    use HasManyRelation;

    protected $fillable = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'tax', 'balance', 'courier', 'payment_status', 'selling_Price',
        'location', 'sales_rep', 'selling_price', 'external_order_no', 'tracking_id', 'product_id', 'subTotal', 'discount_percent',
        'warehouse_id', 'so_number', 's_name', 's_email', 's_phone','address', 's_address_1', 'b_name', 'b_email', 'b_phone', 'b_addres_1','instraction','shipped_by_id', 'order_type_id'
        , 'total', 'discount', 'advance', 'shipping_charges', 'delivery_charges', 'weight'
    ];
    protected $columns = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'total', 'tax', 'balance', 'courier', 'payment_status', 'selling_Price',
        'location', 'sales_rep', 'selling_price', 'external_order_no', 'tracking_id', 'product_id', 'subTotal', 'discount', 'discount_percent'
        , 'so_number', 'name', 'email', 'phone', 's_addres_1', 'b_name', 'b_email', 'b_phone', 'b_addres_1', 'instraction', 'shipped_by_id', 'order_type_id', 'delivery_charges', 'weight'
    ];

    protected $search = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'total', 'tax', 'balance', 'courier', 'payment_status', '', 'selling_price',
        'location', 'sales_rep', 'selling_price', 'external_order_no', 'tracking_id', 'product_id', 'subTotal', 'discount', 'discount_percent'
        , 'so_number', 'name', 'email', 'phone', 'instraction', 'shipped_by_id', 'order_type_id', 'delivery_charges', 'weight'
    ];
    protected $appends = ['text', 'net_total'];

    public function getTextAttribute()
    {

    }

    public function getNetTotalAttribute()
    {
        return ($this->attributes['total'] + $this->attributes['shipping_charges'] - ($this->attributes['discount'] + $this->attributes['advance']));
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
        return $this->hasMany(Order_item::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');

    }

    public function status()
    {
        return $this->belongsTo(Delivery_status::class, 'status_id', 'id');
    }

    public function shipped()
    {
        return $this->belongsTo(Shipped::class, 'shipped_by_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function ordertype()
    {
        return $this->belongsTo(Order_type::class, 'order_type_id', 'id');
    }

    public function status_logs()
    {
        return $this->hasMany(Statuslog::class);
    }

    public function courier()
    {
        return $this->belongsToMany(Courier::class,'shipped_by_id', 'id');
    }


}
