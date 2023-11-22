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
        'account_id', 'subledger_title', 'active'
    ];
    protected $columns = [
         'account_id', 'subledger_title', 'active'
    ];
    protected $fillable = [
        'account_id', 'subledger_title', 'active'
    ];
}
