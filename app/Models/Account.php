<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\Search;


class Account extends Model implements Auditable
{
   
    use HasFactory, Notifiable, HasRoles , SoftDeletes,Search, \OwenIt\Auditing\Auditable;
   

    protected $fillable = [
        'accounttitle', 'accountcode', 'active', 'user_id', 'opening_balance', 'opening_type',
        'gain_loss_on_exchange', 'currency_id', 'rate', 'description', 'nature', 'group_id', 'level', 'short', 'company_id','op_debit','op_credit','op_date'
    ];

    protected $search = ['id', 'accountcode', 'accounttitle', 'created_at', 'active'];
    protected $columns = ['id', 'accountcode', 'accounttitle', 'created_at', 'active'];

    public function group()
    {
        return $this->belongsTo(Account_group::class, 'group_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function gain_loss_account()
    {
        return $this->belongsTo(Account::class, 'gain_loss_on_exch_account_id', 'id');
    }

    protected $appends = ['text', 'name'];

    public function getTextAttribute()
    {
        return $this->attributes['accountcode'] . ' - ' . $this->attributes['accounttitle'];
    }
    public function getNameAttribute()
    {
        return $this->attributes['accounttitle'];
    }



}
