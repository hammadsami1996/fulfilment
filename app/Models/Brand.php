<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Brand extends Model implements Auditable
{
    use HasFactory, Notifiable, SoftDeletes,Search,\OwenIt\Auditing\Auditable;
   
    protected $fillable = [
        'title', 'status', 'active',
    ];
    protected $columns = [
        'title', 'status', 'active',
    ];

    protected $search = [
        'title', 'status', 'active',
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }
}
