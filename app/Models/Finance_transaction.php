<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Support\Search;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Finance_transaction extends Model implements Auditable
{
    use HasFactory, Notifiable,SoftDeletes,\OwenIt\Auditing\Auditable,Search;

    protected $fillable = ['vid', 'did', 'voucher_type', 'voucher_date', 'voucher_number', 'account_id','contra_account_id', 'account_title', 'group_id', 'subledger_id', 'subledger_type', 'subledger_code', 'detail_remarks', 'master_remarks', 'rate', 'currency_id', 'fc_debit', 'fc_credit', 'debit', 'credit', 'serial', 'cost_center_id', 'cost_center_name'];
}
