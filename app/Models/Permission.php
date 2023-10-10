<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends Model implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Search,SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $connection = 'mysql';

    protected $fillable = [
        'name',
    ];
    protected $columns = [
        "id",
        "name",
    ];


    protected $search = [
        "name",
    ];

    public function groups()
    {
        return $this->hasMany(Permission::class, 'group_id');
    }

    public function menus()
    {
        return $this->hasMany(Permission::class, 'menu_id')->with('groups');
    }
}
