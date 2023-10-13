<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class ProductAttribute extends Model implements Auditable
{
    use HasFactory,  \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'parent_product_id', 'product_id','group_id','value_id'
    ];
    protected $columns = [
        'parent_product_id', 'product_id','group_id','value_id'
    ];
}

