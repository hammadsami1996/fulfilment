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
        'state_name',

    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }
    protected $columns = [
        "id",
        "state_name",
    ];
    protected $search = [
        "state_name",
    ];

}
