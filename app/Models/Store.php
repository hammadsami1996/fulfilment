<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Store extends Model implements Auditable
{
    use HasFactory, Search, Notifiable, HasRoles,SoftDeletes,  \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'name', 'location', 'company_id','store_type','plate_form','access_token','store_address','img',
        'api_key','api_secret','word_address','mim_api_key','mim_store_address' , 'warehouse_id'
    ];
    protected $columns = [
        'name', 'location','company_id',
    ];

    protected $search = [
        'name', 'location','company_id',
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['name'];
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}
