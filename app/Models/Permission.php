<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Search;
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
    public function centralPermissions()
    {
        // Retrieve permissions from the central database
        return Permission::on('mysql')->get();
    }
}
