<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Purchase extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = [
        'supplier_id', 'po_number', 'po_reference_number', 'po_date', 'due_date', 'discount', 'sku', 'name',
        'qty', 'purchasing_price', 'tax', 'sub_total'
    ];
    protected $columns = [
        'supplier_id', 'po_number', 'po_reference_number', 'po_date', 'due_date', 'discount', 'sku', 'name',
        'qty', 'purchasing_price', 'tax', 'sub_total'
    ];

    protected $search = [
        'supplier_id', 'po_number', 'po_reference_number', 'po_date', 'due_date', 'discount', 'sku', 'name',
        'qty', 'purchasing_price', 'tax', 'sub_total'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
