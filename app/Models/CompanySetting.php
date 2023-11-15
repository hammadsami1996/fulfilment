<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CompanySetting extends Model implements Auditable
{
    use HasFactory,SoftDeletes,\OwenIt\Auditing\Auditable;

    protected $fillable = [
        'key', 'value', 'company_id', 'active'
    ];
    protected $columns = [
        'key', 'value', 'company_id', 'active'
    ];
    protected $search = [
        'key', 'value', 'active'
    ];
}
