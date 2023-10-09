<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSet extends Model
{
    use HasFactory;
    protected $fillable =[
        'group_title',
        'sets',
        'groups',
        'active',
        'deleted',
        'active',
        'edit_by',
        'add_by',


    ];
    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->attributes['group_title'];
    }
    public function sets()
    { return $this->belongsTo(AttributeSet::class,'sets','id');

    }
    public function group()
    { return $this->belongsTo(AttributeGroup::class,'groups','id');

    }
    public function attribute_groups()
    {
        return $this->hasmany(ProductAttributeValue::class,'groups','groups');

    }
}
