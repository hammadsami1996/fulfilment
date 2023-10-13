<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class ProductAttribute extends Model implements Auditable
{
    use HasFactory,Search,  \OwenIt\Auditing\Auditable;

    public function groups()
    {
        return $this->hasMany(ProductAttributeGroup::class, 'product_id', 'id');
    }
}

