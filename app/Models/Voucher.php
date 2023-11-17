<?php

namespace App\Models;

use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Voucher extends Model
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes, Search, HasManyRelation;
    protected $fillable = [
        'id','date', 'voucher_type', 'payment_type',  'remarks'
    ];
    protected $columns = [
        'date', 'voucher_type', 'payment_type', 'remarks','number'
    ];

    protected $search = [
        'date', 'voucher_type', 'payment_type','remarks','number'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['voucher_type'];
    }
    public function items()
    {
        return $this->hasMany(Voucher_item::class, 'id');
    }

}
