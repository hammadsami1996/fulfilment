<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Store extends Model implements Auditable
{
    use HasFactory, Search, Notifiable,SoftDeletes,  \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name', 'location', 'company_id','store_type','plate_form','access_token','store_address','img',
        'api_key','api_secret','word_address','mim_api_key','mim_store_address' , 'warehouse_id','fetch_order'
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
        $data = Store::with('company')->where('id', $this->attributes['company_id'])->first();
        if($data != null)
        {
            $path = $this->getParent($data->company);
            $path .= '->' . $this->attributes['name'];
        } else{
            $path = $this->attributes['name'];
        }
//        dd($path);
        return $path;
//        return $this->attributes['name'];
    }
    public function getParent($model)
    {
        if($model != null){
            $path = $this->getParent($model->company);
            $path  .= '' . $model->name;
        }else {
            $path = $model;
        }
        return $path;
    }
//    public function parent()
//    {
//        return $this->belongsTo(Store::class, 'company_id')->with('parent')->where('name', '<>', 'Main Company');
//    }
//    public function child()
//    {
//        return $this->hasMany(Store::class, 'company_id', 'id')->with('child');
//    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}
