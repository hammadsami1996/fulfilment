<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use App\Support\Search;
use App\Support\HasManyRelation;

class Finance_transaction_master extends Model implements Auditable
{
    use HasFactory,SoftDeletes,\OwenIt\Auditing\Auditable,Search,HasManyRelation;

    protected $fillable = ['voucher_date', 'voucher_type', 'reference_no', 'detail_remarks', 'debit', 'credit'];
    protected $columns = ['voucher_date', 'voucher_type', 'reference_no' ,'detail_remarks', 'debit', 'credit'];
    protected $search = [ 'detail_remarks','voucher_date', 'voucher_type', 'debit', 'credit'];
     public function items()
    {
        return $this->hasMany(Finance_transaction::class);
    }
    // public function account(){
    //     return $this->belongsTo(Account::class, 'account_id', 'id');
    // }
    // public function subledger()
    // {
    //     return $this->belongsTo(subledger::class, 'subledger_id', 'id');
    // }
}
