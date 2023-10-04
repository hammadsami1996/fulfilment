<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City_Courier extends Model
{
    use HasFactory;

    protected $table = 'city_courier';
    protected $fillable = [
        'city_id',
        'courier_id',
        'delivery_charges',
    ];
}
