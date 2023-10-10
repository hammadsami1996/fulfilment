<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Delivery_status extends Model implements Auditable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes,Search,\OwenIt\Auditing\Auditable;
    
    protected $table = 'delivery_status';
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
