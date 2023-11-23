<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\Search;

class SubLedger extends Model
{
    use HasFactory,Search;

    protected $table = 'sub_ledgers';
    protected $search = [
         'subledger_title', 'active'
    ];
    protected $columns = [
          'subledger_title', 'active'
    ];
    protected $fillable = [
         'subledger_title', 'active'
    ];
    protected $appends = ['text'];


    public function getTextAttribute()
    {
        return $this->attributes['subledger_title'];
    }
}
