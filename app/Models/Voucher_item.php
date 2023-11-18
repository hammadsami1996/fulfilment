<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Traits\HasRoles;

class Voucher_item extends Model
{
    use HasFactory, Notifiable,SoftDeletes, Search;
    protected $table = 'voucher_items';
    protected $fillable = [
        'account_id','subledger', 'debit', 'credit','reference'
    ];
    protected $columns = [
        'account_id','subledger', 'debit', 'credit','reference'
        ];

    protected $search = [
        'account_id','subledger', 'debit', 'credit','reference'
        ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['account_id'];
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
