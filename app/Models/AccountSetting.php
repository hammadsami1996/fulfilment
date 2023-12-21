<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Support\Search;

class AccountSetting extends Model implements Auditable
{
    use HasFactory,\OwenIt\Auditing\Auditable,Search;
    
    protected $fillable = [
        'key', 'value',
    ];
    protected $columns = [
        'key', 'value', 
    ];

    protected $search = [
        'key'
    ];

    protected $appends = ['text'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'value', 'id');
    }

    public function getTextAttribute()
    {
        return $this->attributes['key'];
    }

}
