<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Support\HasManyRelation;

class Order extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    use HasManyRelation;
    protected $fillable = [
        'store_id', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status','selling_Price',
        'location', 'sales_rep', 'selling_price', 'external_order_no','tracking_id', 'product_id', 'subTotal','discount','discount_percent',
        'warehouse_id', 'so_number'

    ];
    protected $columns = [
        'store_id', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status','selling_Price',
        'location', 'sales_rep', 'selling_price', 'external_order_no','tracking_id', 'product_id', 'subTotal','discount','discount_percent'
        , 'so_number'
    ];

    protected $search = [
        'store_id', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status','', 'selling_price',
        'location', 'sales_rep', 'selling_price', 'external_order_no','tracking_id', 'product_id', 'subTotal','discount','discount_percent'
        , 'so_number'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['store_id'];
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

    public function wearhouse()
    {
        return $this->belongsTo(Wearhouse::class, 'warehouse_id', 'id');

    }

    public function status()
    {
        return $this->belongsTo(Delivery_status::class, 'status_id', 'id');
    }

}
