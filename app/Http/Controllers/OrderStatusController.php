<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index() {
        $status = Status::where('head','order')->search();
        return response()->json(['data' => $status]);
    }
}
