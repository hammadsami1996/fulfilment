<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Product extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'name', 'sku', 'price'
    ];
    protected $columns = [
        'name', 'sku', 'price'
    ];

    protected $search = [
        'name', 'sku', 'price'
    ];
    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'product', 'id');
    }

}
