<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductAttributeValue extends Model implements Auditable
{
    use HasFactory, Search,\OwenIt\Auditing\Auditable;

    protected $fillable = [
        "title"
    ];
    protected $columns = [
        "title"
    ];

    protected $search = [
        "title"
    ];
}
