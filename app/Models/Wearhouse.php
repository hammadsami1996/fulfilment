<?php

namespace App\Models;

use App\Support\Search;
use App\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Wearhouse extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;

    protected $fillable = [
        'name', 'location', 'parent_id'
    ];
    protected $columns = [
        'name', 'location'
    ];

    protected $search = [
        'name', 'location',
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        $data = Wearhouse::with('parent')->where('id', $this->attributes['parent_id'])->first();
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
        $data = Wearhouse::with('parent')->where('id', $this->attributes['parent_id'])->first();
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
        return $this->belongsTo(Wearhouse::class, 'parent_id')->with('parent')->where('name', '<>', 'Main Wearhouse');
    }

    public function child()
    {
        return $this->hasMany(Wearhouse::class, 'parent_id', 'id')->with('child');
    }

}
