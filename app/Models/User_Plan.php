<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Support\Search;

class User_Plan extends Model
{
    use HasFactory, Search, SoftDeletes;
    protected $table = 'user_plans';

    protected $fillable = [

        "price",
        "plain_id",
        "user_id",
        "created_by",

    ];

    protected $columns = [

        "price",
        "plain_id",
        "user_id",
    ];

    protected $search = [
        "price",
        "plain_id",
        "user_id",
    ];
}
