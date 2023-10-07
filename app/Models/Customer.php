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
        'name', 'email', 'phone', 'balance', 'type_id', 'discount', 'address', 'b_country_id',
        'b_city_id', 'number', 'cnic', 'b_name', 'b_phone', 'b_address_1', 'b_address_2', 's_name',
        's_phone', 's_address_1', 's_address_2', 'category_id', 's_country_id', 's_city_id','quantity','date'
    ];
    protected $columns = [
        'name', 'email', 'phone', 'balance', 'type_id', 'discount', 'address', 'b_country_id',
        'b_city_id', 'number', 'cnic', 'b_name', 'b_phone', 'b_address_1', 'b_address_2', 's_name',
        's_phone', 's_address_1', 's_address_2', 'category_id', 's_country_id', 's_city_id','quantity','date'
    ];

    protected $search = [
        'name', 'email', 'phone', 'balance', 'type_id', 'discount', 'address', 'b_country_id',
        'b_city_id', 'number', 'cnic', 'b_name', 'b_phone', 'b_address_1', 'b_address_2', 's_name',
        's_phone', 's_address_1', 's_address_2', 'category_id', 's_country_id', 's_city_id','quantity','date'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name']
//            . ' - ' . $this->attributes['phone'] . PHP_EOL . ' - ' . $this->attributes['s_address_1']
            ;
    }


    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function s_country()
    {
        return $this->belongsTo(Country::class,  's_country_id', 'id');
    }
    public function b_country()
    {
        return $this->belongsTo(Country::class, 'b_country_id',  'id');
    }

    public function s_city()
    {
        return $this->belongsTo(City::class,  's_city_id', 'id');
    }
    public function b_city()
    {
        return $this->belongsTo(City::class,  'b_city_id', 'id');
    }

}
