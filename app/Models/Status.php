<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class Status extends Model implements Auditable
{
    protected $connection = 'mysql';

    use HasFactory, Search, Notifiable, HasRoles, \OwenIt\Auditing\Auditable;

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
