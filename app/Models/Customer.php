<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use HasFactory, Notifiable,SoftDeletes, Search, \OwenIt\Auditing\Auditable;


    protected $fillable = [
        'name', 'email', 'phone',
        'discount', 'b_country_id',
        'b_city_id',  'cnic', 'b_name', 'b_phone', 'b_address_1', 's_name',
        's_phone', 's_address_1', 'category_id', 's_country_id', 's_city_id', 'quantity'];
    protected $columns = [
        'name', 'email', 'phone',
        'discount', 'b_country_id',
        'b_city_id',  'cnic', 'b_name', 'b_phone', 'b_address_1', 's_name',
        's_phone', 's_address_1', 'category_id', 's_country_id', 's_city_id', 'quantity'];

    protected $search = [
        'name', 'email', 'phone',
         'b_country_id',
        'b_city_id',  'cnic', 'b_name', 'b_phone', 'b_address_1', 's_name',
        's_phone', 's_address_1', 'category_id', 's_country_id', 's_city_id'


    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name']//            . ' - ' . $this->attributes['phone'] . PHP_EOL . ' - ' . $this->attributes['s_address_1']
            ;
    }


    // public function type()
    // {
    //     return $this->belongsTo(Type::class, 'type_id', 'id');
    // }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function s_country()
    {
        return $this->belongsTo(Country::class, 's_country_id', 'id');
    }

    public function b_country()
    {
        return $this->belongsTo(Country::class, 'b_country_id', 'id');
    }

    public function s_city()
    {
        return $this->belongsTo(City::class, 's_city_id', 'id');
    }

    public function b_city()
    {
        return $this->belongsTo(City::class, 'b_city_id', 'id');
    }

}
