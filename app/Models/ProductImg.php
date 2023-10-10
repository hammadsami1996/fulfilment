<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ProductImg extends Model implements Auditable
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes,\OwenIt\Auditing\Auditable,Search;
    
    protected $fillable = [
        'img','imgurl', 'product_id'
    ];
    protected $columns = [
        'img','imgurl', 'product_id'
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
