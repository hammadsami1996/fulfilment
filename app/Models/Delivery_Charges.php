<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Delivery_Charges extends Model implements Auditable
{
    use HasFactory, Notifiable, SoftDeletes,Search, \OwenIt\Auditing\Auditable;
    
    protected $table = 'delivery_charges';
    protected $fillable = [
        'country_id', 'weight','charges'
    ];
    protected $columns = [
        'country_id', 'weight','charges'
    ];

    protected $search = [
        'country_id', 'weight','charges'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['charges'];
    }
}
