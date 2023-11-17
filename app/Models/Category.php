<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
    use HasFactory, Notifiable, SoftDeletes,Search, \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'customer_category'
    ];
    protected $columns = [
        'customer_category'

    ];

    protected $search = [
        'customer_category'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['customer_category'];
    }
}
