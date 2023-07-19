<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'store', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status',
        'location', 'sales_rep', 'selling_price'
    ];
    protected $columns = [
        'store', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status',
        'location', 'sales_rep', 'selling_price'
    ];

    protected $search = [
        'store', 'order_date', 'customer_id','city', 'total', 'tax', 'balance', 'courier', 'payment_status',
        'location', 'sales_rep', 'selling_price'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['store'];
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
