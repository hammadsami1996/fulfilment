<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;


class Purchase_item extends Model implements Auditable
{
    use HasFactory, Notifiable,SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'purchase_id', 'product_id', 'qty', 'unit_price', 'value_ex_tax', 'tax_percent', 'tax_amount', 'value_inc_tax'
    ];
    protected $columns = [
        'purchase_id', 'product_id', 'qty', 'unit_price', 'value_ex_tax', 'tax_percent', 'tax_amount', 'value_inc_tax'

    ];

    protected $search = [
        'purchase_id', 'product_id', 'qty', 'unit_price', 'value_ex_tax', 'tax_percent', 'tax_amount', 'value_inc_tax'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }
}
