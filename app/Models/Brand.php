<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Brand extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'title', 'status', 'active',
    ];
    protected $columns = [
        'title', 'status', 'active',
    ];

    protected $search = [
        'title', 'status', 'active',
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }
}
