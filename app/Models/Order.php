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
        'store_id', 'order_date', 'customer_id', 'city_id', 'total', 'tax', 'balance', 'courier_id', 'payment_status', 'location', 'sales_rep', 'selling_price',
        'external_order_no', 'tracking_id', 'product_id', 'sub_total', 'discount', 'discount_percent', 'warehouse_id', 'status_id', 'so_number', 's_name', 's_email', 's_address_1',
        's_phone', 'b_name', 'b_email', 'b_address_1', 'b_phone', 'instraction', 'qunatity', 'order_type_id', 'shipping_charges', 'advance', 'delivery_charges', 'courier_id',
        'weight', 'order_form', 'payment_method', 'item_summary', 'item_summary_mannual', 'coupons', 'coupons_discount', 'redeem_amount', 'net_total', 'comments', 'shipment_services',
        'shipped_ref', 'shipper_slip_link', 'city_name', 'payment_description', 'currency_id', 'currency_symbol', 'currency_value', 'replacement_item_summary', 'replacement_qty'
    ];
    protected $columns = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'tax', 'balance', 'courier_id', 'payment_status', 'location', 'sales_rep', 'selling_price',
        'external_order_no', 'tracking_id', 'product_id', 'sub_total', 'discount', 'discount_percent', 'warehouse_id', 'status_id', 'so_number', 's_name', 's_email', 's_address_1',
        's_phone', 'b_name', 'b_email', 'b_address_1', 'b_phone', 'instruction', 'quantity', 'order_type_id', 'shipping_charges', 'advance', 'delivery_charges', 'courier_id',
        'weight', 'order_form', 'payment_method', 'item_summary', 'item_summary_manual', 'coupons', 'coupons_discount', 'redeem_amount', 'net_total', 'comments', 'shipment_services',
        'shipped_ref', 'shipper_slip_link', 'city_name', 'payment_description', 'currency_id', 'currency_symbol', 'currency_value', 'replacement_item_summary', 'replacement_qty'
    ];

    protected $search = [
        'order_date', 'total', 'tax', 'balance', 'payment_status', 'location', 'sales_rep', 'selling_price', 'external_order_no', 'sub_total', 'discount', 'discount_percent',
        'so_number', 's_name', 's_email', 's_address_1', 's_phone', 'b_name', 'b_email', 'b_address_1', 'b_phone', 'instraction', 'qunatity', 'shipping_charges', 'advance',
        'delivery_charges', 'weight', 'order_form', 'payment_method', 'item_summary', 'item_summary_mannual', 'coupons', 'coupons_discount', 'redeem_amount', 'net_total', 'comments',
        'shipment_services', 'shipped_ref', 'shipper_slip_link', 'city_name', 'payment_description', 'currency_symbol', 'currency_value', 'replacement_item_summary', 'replacement_qty'
    ];
    protected $appends = ['text'];

//    protected $appends = ['text', 'net_total'];

    public function getTextAttribute()
    {

    }

//    public function getNetTotalAttribute()
//    {
//        return ($this->attributes['total'] + $this->attributes['shipping_charges'] - ($this->attributes['discount'] + $this->attributes['advance']));
//    }

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
        return $this->belongsTo(Shipped::class, 'courier_id', 'id');
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
        return $this->belongsToMany(Courier::class, 'courier_id', 'id');
    }


}
