<?php

namespace App\Models;

use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class Product extends Model implements Auditable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, Search, \OwenIt\Auditing\Auditable,HasManyRelation;

    protected $fillable = [
        "head_id", "title", "brand_id", "supplier_id", "category_id", "sku", "cost_price", "selling_price", "barcode",
        "quantity", "product_types", "manage_inventory", "weight"
    ];
    protected $columns = [
        "head_id", "title", "brand_id", "supplier_id", "category_id", "sku", "cost_price", "selling_price", "barcode",
        "quantity", "product_types", "manage_inventory", "weight"
    ];

    protected $search = [
        "title", "sku", "cost_price", "selling_price", "barcode", "quantity", "product_types", "weight"
    ];
    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['title'];
    }

    public function product_img()
    {
        return $this->hasMany(ProductImg::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'head_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function product_attribute()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }

//    public function purchases()
//    {
//        return $this->hasMany(Purchase_item::class)->orderBy('id', 'desc')->limit(3);
//        // return $this->hasMany(Purchase_item::class)->orderBy('id' , 'desc')->limit(3);
//    }
//
//    //mimcart
//    public function prod_grp()
//    {
//        return $this->hasMany(ProductAttribute::class, 'products', 'id');
//    }
//
//    public function product_attribute()
//    {
//        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
//    }
//
//    public function attribute_sets()
//    {
//        return $this->belongsTo(AttributeSet::class, 'attribute_set', 'id');
//    }
//
//    public function product_type()
//    {
//        return $this->belongsTo(ProductType::class, 'product_types', 'id');
//    }


}
