<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'products',
        'groups',
        'value',
        'group_title',
        'value_title',
        'variation',
        'price',
        'sku',
        'sort',
        'status',
        'active',
        'deleted',
        'add_by',
        'edit_by',
        'deleted_by',
        'createdon',
        'updatedon',
    ];


    public function prod_att()
    {
        return $this->belongsTo(AttributeGroup::class, 'groups', 'id');
//        return $this->belongsToMany(Category::class,'category','categories');
    }
}
