<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class ProductAttributeValue extends Model
{
    use HasFactory;
    protected $fillable =[
        'groups',
        'title',
        'image',
        'choose_lenses',
        'color_code',
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
    protected $appends = ['text'];
    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }
}
