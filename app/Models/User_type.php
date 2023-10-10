<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\RefreshesPermissionCache;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class   User_type extends Model implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions,\OwenIt\Auditing\Auditable, RefreshesPermissionCache, Search,SoftDeletes;

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
