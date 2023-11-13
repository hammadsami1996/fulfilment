<?php

namespace App\Models;

use App\Support\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Settings extends Model implements Auditable
{

    use HasFactory, Search, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = 'settings';

    protected $fillable = [
        "key",
        "value",
    ];

    protected $columns = [
        "key",
        "value",
    ];

    protected $search = [
        "key",
        "value",
    ];


    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
}
