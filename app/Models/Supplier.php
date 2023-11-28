<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Supplier extends Model implements Auditable
{
    use HasFactory, Notifiable,SoftDeletes, Search,  \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name', 'company_name', 'website', 'address', 'number_1', 'number_2', 'email', 'opening_balance'
    ];
    protected $columns = [
        'name', 'company_name', 'website', 'address', 'number_1', 'number_2', 'email', 'opening_balance'
    ];

    protected $search = [
        'name', 'company_name', 'website', 'address', 'number_1', 'number_2', 'email', 'opening_balance'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }

    public function subLedger()
    {
        return $this->hasOne(SubLedger::class);
    }
}
