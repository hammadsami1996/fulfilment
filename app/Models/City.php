<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Search;

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

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_city_courier')
            ->withPivot('courier_id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }

}
