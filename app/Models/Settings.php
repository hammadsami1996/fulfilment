<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasFactory;
    use HasFactory, Search, SoftDeletes;
    protected $table = 'settings';

    protected $fillable = [
        "key",
        "value",
    ];

    protected $columns = [
        "key",
        "value",
    ];

    protected $search = [
        "key",
        "value",
    ];
}
