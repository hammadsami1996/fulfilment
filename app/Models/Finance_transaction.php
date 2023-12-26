<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Support\HasManyRelation;
use App\Support\Search;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Finance_transaction extends Model implements Auditable
{
    use HasFactory,HasManyRelation, Notifiable,SoftDeletes,\OwenIt\Auditing\Auditable,Search;

    protected $fillable = ['vid', 'did', 'voucher_type', 'voucher_date', 'voucher_number',
    'account_id','master_remarks', 'finance_transaction_master_id',
    'contra_account_id', 'account_title', 'group_id',  'reference_no',
    // 'subledger_type', 'subledger_code','subledger_id',
     'detail_remarks',  'rate', 'debit', 'credit',
    'currency_id', 'fc_debit', 'fc_credit', 'serial', 'cost_center_id',
     'cost_center_name'];
    protected $columns = [
        'vid', 'did', 'voucher_type', 'voucher_date', 'voucher_number',  'debit', 'credit',
          'account_id','master_remarks', 'finance_transaction_master_id',
        'contra_account_id', 'account_title', 'group_id', 'reference_no',
        // 'subledger_id', 'subledger_type', 'subledger_code',
        //  'detail_remarks', 
         'rate', 'currency_id', 'fc_debit', 'fc_credit', 
         'serial', 'cost_center_id', 'cost_center_name'
    ];
    protected $search = [
        'voucher_type', 'voucher_date', 'voucher_number', 'account_title',
    //    'subledger_type', 'subledger_code',
        'master_remarks', 'rate', 'fc_debit', 'fc_credit', 
       'serial', 'cost_center_name', 'debit', 'credit',
       'master_remarks'
    ];

    // public function items()
    // {
    //     return $this->hasMany(Finance_transaction_master::class);
    // }
    public function account(){
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
    // public function subledger()
    // {
    //     return $this->belongsTo(Customer::class, 'subledger_id', 'id');
    // }
}
