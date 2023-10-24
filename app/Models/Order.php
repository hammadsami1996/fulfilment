<?php

namespace App\Models;

use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model implements Auditable
{
    use HasFactory, HasManyRelation, Search, Notifiable, HasRoles, SoftDeletes, \OwenIt\Auditing\Auditable;


    protected $fillable = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'total', 'tax', 'balance', 'courier_id', 'payment_status', 'location', 'sales_rep', 'selling_price',
        'external_order_no', 'tracking_id', 'product_id', 'sub_total', 'discount', 'discount_percent', 'warehouse_id', 'status_id', 'so_number', 's_name', 's_email', 's_address_1',
        's_phone', 'b_name', 'b_email', 'b_address_1', 'b_phone', 'instructions', 'quantity', 'shipping_charges', 'advance', 'delivery_charges', 'courier_id',
        'weight', 'order_form', 'payment_method', 'item_summary', 'item_summary_manual', 'coupons', 'coupons_discount', 'redeem_amount', 'net_total', 'comments', 'shipment_services',
        'shipped_ref', 'shipper_slip_link', 'city_name', 'payment_description', 'currency_id', 'currency_symbol', 'currency_value', 'replacement_item_summary', 'replacement_qty'
    ];
    protected $columns = [
        'store_id', 'order_date', 'customer_id', 'city_id', 'total', 'tax', 'balance', 'courier_id', 'payment_status', 'location', 'sales_rep', 'selling_price',
        'external_order_no', 'tracking_id', 'product_id', 'sub_total', 'discount', 'discount_percent', 'warehouse_id', 'status_id', 'so_number', 's_name', 's_email', 's_address_1',
        's_phone', 'b_name', 'b_email', 'b_address_1', 'b_phone', 'instructions', 'quantity', 'shipping_charges', 'advance', 'delivery_charges', 'courier_id',
        'weight', 'order_form', 'payment_method', 'item_summary', 'item_summary_manual', 'coupons', 'coupons_discount', 'redeem_amount', 'net_total', 'comments', 'shipment_services',
        'shipped_ref', 'shipper_slip_link', 'city_name', 'payment_description', 'currency_id', 'currency_symbol', 'currency_value', 'replacement_item_summary', 'replacement_qty'
    ];

    protected $search = [
        'order_date', 'total', 'tax', 'balance', 'payment_status', 'location', 'sales_rep', 'selling_price', 'external_order_no', 'sub_total', 'discount', 'discount_percent',
        'so_number', 's_name', 's_email', 's_address_1', 's_phone', 'b_name', 'b_email', 'b_address_1', 'b_phone', 'instructions', 'quantity', 'shipping_charges', 'advance',
        'delivery_charges', 'weight', 'order_form', 'payment_method', 'item_summary', 'item_summary_manual', 'coupons', 'coupons_discount', 'redeem_amount', 'net_total', 'comments',
        'shipment_services', 'shipped_ref', 'shipper_slip_link', 'city_name', 'payment_description', 'currency_symbol', 'currency_value', 'replacement_item_summary', 'replacement_qty'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function status_logs()
    {
        return $this->hasMany(StatusLog::class);
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
        return $this->hasMany(Order_item::class, 'order_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');

    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

}
