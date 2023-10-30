<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Support\Search;
class CourierResponse extends Model
{
    protected $connection = 'mysql';

    use HasFactory,search;

    protected $fillable = [
        'courier_id',
        'title',
    ];
    protected $columns = [
        'courier_id',
        'title',
    ];
    protected $search = [
        'courier_id',
        'title',
    ];
    public function courier_status()
    {
        return $this->belongsToMany(Status::class);
    }
}
