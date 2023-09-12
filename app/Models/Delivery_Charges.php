<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Delivery_Charges extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
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
