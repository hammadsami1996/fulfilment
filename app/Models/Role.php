<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class Role extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, RefreshesPermissionCache, Search;

    protected $fillable = [
        'name',
        'guard_name',
    ];
    protected $columns = [
        "id",
        "name",
    ];
    protected $search = [
        "name",
    ];

    public function permission()
    {
        return DB::connection('mysql')->table('permissions')->whereIn('id', DB::table('role_has_permissions')->where('role_id', $this->id)->pluck('permission_id')->toArray())->get();
    }

    public function permissionss()
    {
        return $this->belongsToMany(Permission::class, tenancy()->tenant->tenancy_db_name . '.role_has_permissions');
    }
}
