<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Counter extends Model implements Auditable
{
    use HasFactory,\OwenIt\Auditing\Auditable;

    public function next($key)
    {
        $found = $this->db()->where('key', $key)->first();
        if (!$found) {
            throw new Exception('No record for counter found');
        }

        return $found->prefix . $found->value;
    }

    public function increase($key)
    {
        $result = $this->db()->where('key', $key)->increment('value');

        if (!$result) {
            throw new Exception('Counter could not increment');
        }

        return $result;
    }

    protected function db()
    {
        return DB::table('counters');
    }

}
