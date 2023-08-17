<?php

namespace App\Models;

use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class OrderViews extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    use HasManyRelation;

    protected $columns = [
        'store_id', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status','selling_Price',
        'location', 'sales_rep', 'selling_price', 'external_order_no','tracking_id', 'product_id', 'subTotal','discount','discount_percent'
    ];

    protected $search = [
        'store_id', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status','', 'selling_price',
        'location', 'sales_rep', 'selling_price', 'external_order_no','tracking_id', 'product_id', 'subTotal','discount','discount_percent'
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
        return $this->hasMany(Order_item::class , 'id', 'order_id');
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
