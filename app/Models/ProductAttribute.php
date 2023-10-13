<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory,Search;

    public function groups()
    {
        return $this->hasMany(ProductAttributeGroup::class, 'product_id', 'id');
    }
}
