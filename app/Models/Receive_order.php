<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasManyRelation;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Support\Search;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Receive_order extends Model implements Auditable
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes, Search, HasManyRelation,\OwenIt\Auditing\Auditable;
   


    protected $fillable = [
        'supplier_id', 'purchase_order_id', 'date',  'note',
        'user_id', 'reference','po_number','po_date'
    ];
    protected $columns = [
        'supplier_id', 'number', 'purchase_order_id', 'date',  'note',
        'user_id', 'reference'
    ];

    protected $search = [
        'supplier_id', 'number', 'purchase_order_id', 'date',  'note',
        'user_id', 'reference'
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Receive_order_item::class, 'receive_order_id', 'id');
    }
}
