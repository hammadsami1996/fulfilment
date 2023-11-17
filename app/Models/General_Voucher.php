<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class General_Voucher extends Model
{
    use HasFactory, Notifiable,SoftDeletes, Search;
    protected $table = 'vouchers';
    protected $fillable = [
        'id','date', 'voucher_type', 'payment_type', 'currency', 'exchange_rate','remarks','number'
    ];
    protected $columns = [
        'date', 'voucher_type', 'payment_type', 'currency', 'exchange_rate','remarks','number'
    ];

    protected $search = [
        'date', 'voucher_type', 'payment_type', 'currency', 'exchange_rate','remarks','number'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['voucher_type'];
    }
}
