<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Account_group extends Model implements Auditable
{
    use HasFactory,SoftDeletes, \OwenIt\Auditing\Auditable;
    

    protected $search = [
        'id', 'groupname', 'class_id'
    ];
    protected $columns = [
        'id', 'code', 'groupname', 'class_id', 'active', 'created_at', 'updated_at'
    ];
    protected $fillable = [
        'code', 'groupname', 'class_id', 'active',
    ];
    public function childs()
    {
        return $this->hasMany(Account::class, 'group_id', 'id');
    }

    public function classes()
    {
        return $this->belongsTo(AccountClass::class, 'class_id', 'id');
    }

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['code'] . ' - ' . $this->attributes['groupname'];
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'group_id', 'id')->where(function($q){
            $q->when(request('hide_zero'),function($sub_query){
                $sub_query->where('debit','<>',0)->orWhere('credit','<>',0)->orWhere('account_period_opening','<>',0);
            });
        });
    }
}
