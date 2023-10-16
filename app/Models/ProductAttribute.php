<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class ProductAttribute extends Model implements Auditable
{
    use HasFactory, Search, \OwenIt\Auditing\Auditable, SoftDeletes;

    public function group()
    {
        return $this->belongsTo(ProductAttributeGroup::class);
    }

    public function value()
    {
        return $this->belongsTo(ProductAttributeValue::class);
    }
}

