<?php

namespace App\Models;

use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;


class Product extends Model implements Auditable
{
    use HasFactory, Notifiable,SoftDeletes, Search, \OwenIt\Auditing\Auditable, HasManyRelation;

    protected $fillable = [
        "head_id", "title", "brand_id", "supplier_id", "category_id", "sku", "cost_price", "selling_price", "barcode",
        "quantity", "product_types", "manage_inventory", "weight"
    ];
    protected $columns = [
        "head_id", "title", "brand_id", "supplier_id", "category_id", "sku", "cost_price", "selling_price", "barcode",
        "quantity", "product_types", "manage_inventory", "weight",'created_at'
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
        return $this->hasMany(ProductImg::class,$this->head_id ? 'product_id' : 'parent_product_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'parent_product_id', 'id');
    }


    public function sub_attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id')->with('group', 'value');
    }

    public function sub_products()
    {
        return $this->hasMany(Product::class, 'head_id')->with('sub_attributes');
    }
}
