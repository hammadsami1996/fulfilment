<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'customer_category'
    ];
    protected $columns = [
        'customer_category'

    ];

    protected $search = [
        'customer_category'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['customer_category'];
    }
}
