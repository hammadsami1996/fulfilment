<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Product extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'title', 'description',  'product_sku', 'model_no',  'barcode', 'manage_inventory',
         'product_types', 'cost_price', 'selling_price',  'start_date',
        'end_date', 'product_category','brand_id', 'head_id'
    ];
    protected $columns = [
        'title', 'description',  'product_sku', 'model_no', 'barcode', 'manage_inventory',
        'quantity', 'product_types', 'cost_price', 'selling_price', 'start_date',
        'end_date', 'product_category','brand_id', 'head_id'
    ];

    protected $search = [
        'title', 'description',  'product_sku', 'model_no', 'barcode', 'manage_inventory',
        'quantity', 'product_types', 'cost_price', 'selling_price',  'start_date',
        'end_date', 'product_category','brand_id', 'head_id'
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
        return $this->belongsTo(ProductCategory::class, 'head_id', 'id')->with('category');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function purchases()
    {
        return $this->hasMany(Purchase_item::class)->orderBy('id' , 'desc')->limit(3);
        // return $this->hasMany(Purchase_item::class)->orderBy('id' , 'desc')->limit(3);
    }

}
