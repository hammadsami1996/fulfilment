<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Support\Search;

class Finance_transaction extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;
    protected $fillable = ['vid', 'did', 'voucher_type', 'voucher_date', 'voucher_number', 'account_id','contra_account_id', 'account_title', 'group_id', 'subledger_id', 'subledger_type', 'subledger_code', 'detail_remarks', 'master_remarks', 'rate', 'currency_id', 'fc_debit', 'fc_credit', 'debit', 'credit', 'serial', 'cost_center_id', 'cost_center_name'];
}
