<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Wearhouse extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'name', 'location'
    ];
    protected $columns = [
        'name', 'location'
    ];

    protected $search = [
        'name', 'location',
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
//    public function inventory()
//    {
//        return $this->hasMany(Inventory::class, 'wearhouse', 'id');
//    }

}
