<?php

namespace App\Http\Controllers;

use App\Models\Shipped;
use Illuminate\Http\Request;

class ShippedController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Shipped::search()]);
    }
}
