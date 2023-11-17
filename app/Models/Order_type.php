<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Order_type extends Model implements Auditable
{
    use HasFactory, Notifiable, SoftDeletes, \OwenIt\Auditing\Auditable,Search;
   

    protected $fillable = [
        'name',
    ];
    protected $columns = [
        'name',
    ];

    protected $search = [
        'name',
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
}
