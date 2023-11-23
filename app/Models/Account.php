<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\Search;


class Account extends Model implements Auditable
{

    use HasFactory, Notifiable, SoftDeletes,Search, \OwenIt\Auditing\Auditable;


    protected $fillable = [
        'accounttitle', 'shortname', 'active',
    ];

    protected $search = [  'accounttitle', 'shortname', 'active',];
    protected $columns = [  'accounttitle', 'shortname', 'active',];

//    public function group()
//    {
//        return $this->belongsTo(Account_group::class, 'group_id', 'id');
//    }
//
//
//    public function user()
//    {
//        return $this->belongsTo(User::class, 'user_id', 'id');
//    }
//
//    public function gain_loss_account()
//    {
//        return $this->belongsTo(Account::class, 'gain_loss_on_exch_account_id', 'id');
//    }

    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['accounttitle'];
    }



}
