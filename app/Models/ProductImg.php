<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class ProductImg extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'img', 'product_id'
    ];
    protected $columns = [
        'img', 'product_id'
    ];

    protected $search = [
        'img', 'product_id'
    ];
//    protected $appends = ['text'];
//
//    public function getTextAttribute()
//    {
//        return $this->attributes['title'];
//    }
}
