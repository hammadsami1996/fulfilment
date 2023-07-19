<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Supplier extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'name', 'company_name', 'website', 'address', 'number_1', 'number_2', 'email', 'opening_balance'
    ];
    protected $columns = [
        'name', 'company_name', 'website', 'address', 'number_1', 'number_2', 'email', 'opening_balance'
    ];

    protected $search = [
        'name', 'company_name', 'website', 'address', 'number_1', 'number_2', 'email', 'opening_balance'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
}
