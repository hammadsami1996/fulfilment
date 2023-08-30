<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Support\Search;

class Account_group_class_type extends Model
{
    use HasFactory, Notifiable, HasRoles;
    use Search;

    protected $table = 'account_group_class_types';
    protected $search = [
        'id', 'class_type', 'main_class'
    ];
    protected $columns = [
        'id', 'code', 'class_type', 'main_class', 'active', 'created_at', 'updated_at'
    ];
    protected $fillable = [
        'code', 'class_type', 'main_class', 'active'
    ];

    public function classes()
    {
        return $this->hasMany(AccountClass::class, 'class_type_id', 'id')->with('groups')->where(function($q){
            $q->when(request('hide_zero'),function($sub_query){
                $sub_query->where('debit','<>',0)->orWhere('credit','<>',0)->orWhere('account_period_opening','<>',0);
            });
        });
    }
    public function childs()
    {
        return $this->hasMany(AccountClass::class, 'class_type_id', 'id');
    }

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['code'] . ' - ' . $this->attributes['class_type'];
    }
}
