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
        return $this->getParent($this);
    }

    public function getParent($model)
    {
        if ($model->category != null) {
            $path = $this->getParent($model->category);
            $path .= '->' . $model->name;
        } else {
            $path = $model->name;
        }
        return $path;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'head_id', 'id')->with('category');
    }
}
