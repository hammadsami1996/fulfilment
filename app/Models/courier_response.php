<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class courier_response extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];
    protected $columns = [
        'title',
    ];

    protected $search = [
        'title',
    ];



}
