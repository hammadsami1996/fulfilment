<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Courier extends Model implements Auditable
{
    protected $connection = 'mysql';

    use HasFactory, Notifiable, HasRoles , SoftDeletes,Search,\OwenIt\Auditing\Auditable;
   

    protected $fillable = [
        'name',
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
    // public function cities()
    // {
    //     return $this->belongsToMany(City::class);
    // }
    public function cities()
    {
        return $this->belongsToMany(City::class, 'tenant_database.city_courier');
    }
}
