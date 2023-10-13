<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeGroup extends Model
{
    use HasFactory, Search;

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
