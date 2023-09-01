<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Country extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Search;
    protected $table = 'countries';
    protected $fillable = [
        'name',
        'status',
        'other_city_id',

    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
    protected $columns = [
        "id",
        "name",
    ];
    protected $search = [
        "name",
    ];
}
