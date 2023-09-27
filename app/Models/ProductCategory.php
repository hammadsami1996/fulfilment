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
        'name', 'parent_id'
    ];
    protected $columns = [
        'name', 'parent_id'
    ];

    protected $search = [
        'name', 'parent_id'
    ];
    protected $appends = ['text'];

    public function getTextAttribute()
    {
        $data = ProductCategory::with('parent')->where('id', $this->attributes['parent_id'])->first();
        if ($data != null) {
            $path = $this->getParent($data);
            $path .= ' -> ' . $this->attributes['name'];
        } else {
            $path = $this->attributes['name'];
        }
//        dd($path);
        return $path;
    }
    public function getPathAttribute()
    {
        $data = Warehouse::with('parent')->where('id', $this->attributes['parent_id'])->first();
        if ($data != null) {
            $path = $this->getParent($data);
        } else {
            $path = "";
        }
//        dd($path);
        return $path;
    }
    public function getParent($model)
    {
        if ($model->parent != null) {
            $path = $this->getParent($model->parent);
            $path .= ' -> ' . $model->name;
        } else {
            $path = $model->name;
        }
        return $path;
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id')->with('parent')->where('name', '<>', 'Main Category');
    }
    public function child()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')->with('child');
    }
}
