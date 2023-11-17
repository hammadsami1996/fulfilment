<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class City extends Model implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable,Search ,\OwenIt\Auditing\Auditable;

    protected $connection = 'mysql';
    protected $table = 'cities';
    protected $fillable = [
        'country_id',
        'state_id',
        'title',
        'status',
        //        'state_id',

    ];
    protected $appends = ['text'];
    protected $columns = [
        "id",
        "state_id",
    ];
    protected $search = [
        "name",
    ];

    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
    public function getTraxAttribute()
    {
        return json_decode($this->attributes['trax']);
    }
    public function getLeopardsAttribute()
    {
        return json_decode($this->attributes['leopards']);
    }
    public function getTcsAttribute()
    {
        return json_decode($this->attributes['tcs']);
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_city_courier')
            ->withPivot('courier_id');
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
    public function couriers()
    {
        return $this->belongsToMany(Courier::class, tenancy()->tenant->tenancy_db_name.'.city_courier')
            ->withPivot('courier_id','delivery_charges');
    }
}
