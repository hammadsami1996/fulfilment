<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductAttributeValue extends Model implements Auditable
{
    use HasFactory,\OwenIt\Auditing\Auditable;

    protected $fillable = [
        'title', 'group_id'
    ];
    protected $columns = [
        'title','group_id'
    ];
    protected $search = [
        'title'
    ];
}
