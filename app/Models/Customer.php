<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Customer extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'name', 'email', 'phone','cateogory','balance','type_id','discount','address','country_id',
        'state_id', 'city_id', 'number', 'cnic'
    ];
    protected $columns = [
        'name', 'email', 'phone','cateogory','balance','type_id','discount','address','country_id',
        'state_id', 'city_id', 'number', 'cnic'    ];

    protected $search = [
        'name', 'email', 'phone','cateogory','balance','type_id','discount','address','country_id',
        'state_id', 'city_id', 'number', 'cnic'    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
