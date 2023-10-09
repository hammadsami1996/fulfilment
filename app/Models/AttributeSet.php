<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    use HasFactory;
    protected $fillable =[
        'groups',
        'title',
        'sort',
        'status',
        'active',
        'deleted',
        'add_by',
        'edit_by',
        'deleted_by',
        'active',
        'edit_by',
    ];
    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }
    public function attribute_set(){

        return $this->hasmany(AssignSet::class,'sets','id');
    }

}
