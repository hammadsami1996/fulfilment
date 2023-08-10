<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        if (DB::connection('mysql')->table('domains')->where(['domain' => request()->getHost()])->exists()) {
            $data = DB::connection('mysql')->table('plans')->paginate(10);
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['data' => Plan::search()]);

        }
    }

    public function create()
    {
        $form = [
            "name" => '',
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $model = new Plan();
        $model->fill($request->all());
        $model->created_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function show($id)
    {
        $model = Plan::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    public function edit($id)
    {
        $model = Plan::findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $model = Plan::findOrFail($id);
        $model->fill($request->all());
        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function destroy($id)
    {
        $model = Plan::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }

    public function plan()
    {
        $data = Plan::get();
        return view('plan', compact('data'));

    }
    public function task()
    {
        $data = Plan::get();
        return view('plan', compact('data'));

    }
}
