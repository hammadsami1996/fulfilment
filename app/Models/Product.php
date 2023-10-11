<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes,Search,\OwenIt\Auditing\Auditable;
   
    protected $fillable = [
        'title', 'description',  'sku', 'model_no',  'barcode', 'manage_inventory',
         'product_types', 'cost_price', 'selling_price',  'start_date',
        'end_date', 'product_category','brand_id', 'head_id', 'supplier_id', 'weight','quantity'
    ];
    protected $columns = [
        'title', 'description',  'sku', 'model_no', 'barcode', 'manage_inventory',
        'quantity', 'product_types', 'cost_price', 'selling_price', 'start_date',
        'end_date', 'product_category','brand_id', 'head_id','supplier_id','weight'
    ];

    protected $search = [
        'title', 'description',  'sku', 'model_no', 'barcode', 'manage_inventory',
        'quantity', 'product_types', 'cost_price', 'selling_price',  'start_date',
        'end_date', 'product_category','brand_id', 'head_id','supplier_id','weight'
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
    public function purchases()
    {
        return $this->hasMany(Purchase_item::class)->orderBy('id' , 'desc')->limit(3);
        // return $this->hasMany(Purchase_item::class)->orderBy('id' , 'desc')->limit(3);
    }

    //mimcart
    public function prod_grp()
    {
        return $this->hasMany(ProductAttribute::class, 'products', 'id');
    }
    public function test()
    {
        return $this->hasMany(ProductAttribute::class, 'products', 'id');
    }
    public function attribute_sets()
    {
        return $this->belongsTo(AttributeSet::class, 'attribute_set', 'id');
    }



}
