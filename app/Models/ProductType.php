<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    use Search;

    protected $fillable = [
        'title', 'active', 'deleted', 'created_at','sort', 'updated_at', 'status',
    ];
    protected $columns = [
        'title', 'active', 'deleted', 'created_at','sort', 'updated_at', 'status',
    ];
    protected $search = [
        'title', 'active', 'deleted', 'created_at','sort', 'updated_at', 'status',
    ];

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }
}
