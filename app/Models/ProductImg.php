<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ProductImg extends Model implements Auditable
{
    use HasFactory, Notifiable,SoftDeletes,\OwenIt\Auditing\Auditable,Search;

    protected $fillable = [
        'img','img_url', 'product_id'
    ];
    protected $columns = [
        'img','img_url', 'product_id'
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
