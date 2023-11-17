<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Warehouse extends Model implements Auditable
{
    use HasFactory, Search, Notifiable,SoftDeletes,  \OwenIt\Auditing\Auditable;
   

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
        $data = Warehouse::with('parent')->where('id', $this->attributes['parent_id'])->first();
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
        return $this->belongsTo(Warehouse::class, 'parent_id')->with('parent')->where('name', '<>', 'Main Warehouse');
    }

    public function child()
    {
        return $this->hasMany(Warehouse::class, 'parent_id', 'id')->with('child');
    }

}
