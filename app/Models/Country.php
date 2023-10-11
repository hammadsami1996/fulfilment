<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Country extends Model implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Search,\OwenIt\Auditing\Auditable;

    protected $connection = 'mysql';
    protected $table = 'countries';
    protected $fillable = [
        'title',
        'status',
        'other_city_id',

    ];
    protected $appends = ['text'];
    protected $columns = [
        "id",
        "name",
    ];
    protected $search = [
        "name",
    ];

    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
}
