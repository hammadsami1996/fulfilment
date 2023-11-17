<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Support\HasManyRelation;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Purchase extends Model implements Auditable
{

    use HasFactory,HasManyRelation, Notifiable,Search,SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'supplier_id', 'po_number', 'po_reference_number', 'po_date', 'due_date', 'discount', 'sku', 'name',
        'qty', 'purchasing_price', 'tax', 'sub_total','discount_percent','total'
    ];
    protected $columns = [
        'supplier_id', 'po_number', 'po_reference_number', 'po_date', 'due_date', 'discount', 'sku', 'name',
        'qty', 'purchasing_price', 'tax', 'sub_total','total'
    ];

    protected $search = [
        'supplier_id', 'po_number', 'po_reference_number', 'po_date', 'due_date', 'discount', 'sku', 'name',
        'qty', 'purchasing_price', 'tax', 'sub_total','total'
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
    public function items()
    {
        return $this->hasMany(Purchase_item::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}

