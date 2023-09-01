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
        'name',
        'status',
//        'state_id',

    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }

    protected $columns = [
        "id",
        "state_id",
    ];
    protected $search = [
        "name",
    ];

}
