<?php

namespace App\Http\Controllers;

use App\Models\Order_type;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Order_type::search()]);
    }
}
