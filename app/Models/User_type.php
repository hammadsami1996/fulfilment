<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class User_type extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, RefreshesPermissionCache, Search;

    protected $fillable = [
        'user_type',

    ];
    protected $columns = [
        "id",
        "user_type",
    ];
    protected $search = [
        "user_type",
    ];
}
