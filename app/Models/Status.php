<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;


class Status extends Model implements Auditable
{
    protected $connection = 'mysql';
    public $timestamps = false;

    use HasFactory, Search, Notifiable, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name','responses','message','stock_qty','sort','email','sms','active'
    ];
    protected $columns = [
        'name','responses','message','stock_qty','sort','email','sms','active'
    ];
    protected $search = [
        'name','responses','message','stock_qty','sort','email','sms','active'
    ];
    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }

    public function courier_responses()
    {
        return $this->belongsToMany(CourierResponse::class);
    }

}
