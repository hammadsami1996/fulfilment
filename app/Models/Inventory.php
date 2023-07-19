<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Inventory extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'product_id', 'wearhouse_id', 'qty', 'price'
    ];
    protected $columns = [
        'product_id', 'wearhouse_id', 'qty', 'price'
    ];

    protected $search = [
        'product_id', 'wearhouse_id', 'qty', 'price'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['product_id'];
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function wearhouse()
    {
        return $this->belongsTo(Wearhouse::class, 'wearhouse_id', 'id');
    }
}