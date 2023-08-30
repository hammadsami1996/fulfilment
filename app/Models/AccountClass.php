<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountClass extends Model
{
    use HasFactory;

    
    protected $table = 'account_group_classes';
    protected $search = [
        'id', 'classname', 'class_type_id'
    ];
    protected $columns = [
        'id', 'code', 'classname', 'class_type_id', 'active', 'created_at', 'updated_at'
    ];
    protected $fillable = [
        'code', 'classname', 'class_type_id', 'active'
    ];
    public function childs()
    {
        return $this->hasMany(Account_group::class, 'class_id', 'id');
    }
    public function class_type()
    {
        return $this->belongsTo(AccountClassType::class, 'class_type_id', 'id');
    }

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['code'] . ' - ' . $this->attributes['classname'];
    }

    public function groups()
    {
        return $this->hasMany(Account_group::class, 'class_id', 'id')->where(function($q){
            $q->when(request('hide_zero'),function($sub_query){
                $sub_query->where('debit','<>',0)->orWhere('credit','<>',0)->orWhere('account_period_opening','<>',0);
            });
        });
    }
}
