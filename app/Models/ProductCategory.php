<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class ProductCategory extends Model
{

    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'name', 'head_id'
    ];
    protected $columns = [
        'name', 'head_id'
    ];

    protected $search = [
        'name', 'head_id'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
}
