<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Company extends Model implements Auditable
{
    use HasFactory, Notifiable, SoftDeletes,Search,\OwenIt\Auditing\Auditable;
    

    protected $fillable = [
        'name', 'phone', 'tax_number', 'city_id', 'country_id', 'postal', 'province', 'address', 'logo', 'email'
    ];
    protected $columns = [
        'name',
    ];

    protected $search = [
        'name',
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'company_city_courier')
            ->withPivot('courier_id');
    }
    public function stores()
    {
        return $this->hasMany(Store::class, 'company_id', 'id');
    }

}
