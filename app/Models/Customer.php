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
        'name', 'email', 'phone','balance','type_id','discount','address','country_id',
        'state_id', 'city_id', 'number', 'cnic', 'b_name', 'b_phone', 'b_address_1', 'b_address_2', 's_name',
        's_phone', 's_address_1', 's_address_2','category_id'
    ];
    protected $columns = [
        'name', 'email', 'phone','balance','type_id','discount','address','country_id',
        'state_id', 'city_id', 'number', 'cnic' , 'b_name', 'b_phone', 'b_address_1', 'b_address_2', 's_name',
        's_phone', 's_address_1', 's_address_2', 'category_id'
    ];

    protected $search = [
        'name', 'email', 'phone','balance','type_id','discount','address','country_id',
        'state_id', 'city_id', 'number', 'cnic' , 'b_name', 'b_phone', 'b_address_1', 'b_address_2', 's_name',
        's_phone', 's_address_1', 's_address_2' , 'category_id'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
