<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;
//    protected $table='products_attributes_groups';
    protected $fillable =[
        'title',
        'sets',
        'show_filter',
        'show_on_front',
        'sort',
        'status',
        'active'

    ];
    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }
    public function productattribute_value(){
        return $this->hasmany(ProductAttributeValue::class,'groups','id');
    }
}
