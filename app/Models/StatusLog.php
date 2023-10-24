<?php

namespace App\Models;

use App\Support\HasManyRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class StatusLog extends Model implements Auditable
{
    use HasFactory ,Notifiable, HasRoles,SoftDeletes, HasManyRelation, \OwenIt\Auditing\Auditable;



    protected $fillable = [
        'order_id' , 'previous_sts' ,'updated_sts' , 'user_id'
    ];
    protected $columns = [
        'order_id' , 'previous_sts' ,'updated_sts' , 'user_id'
    ];

    protected $search = [
        'order_id' , 'previous_sts' ,'updated_sts' , 'user_id'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'previous_sts', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
