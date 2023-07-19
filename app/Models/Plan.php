<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Plan extends Model
{
    use HasFactory, Search, SoftDeletes;
    protected $table = 'plans';

    protected $fillable = [
        "name",
        "price",
    ];

    protected $columns = [
        "name",
        "price",
    ];

    protected $search = [
        "name",
        "price",
    ];
}
