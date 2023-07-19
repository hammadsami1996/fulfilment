<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{
    public function index()
    {
        return response()->json(['data' => User::with('usertype')
            ->when(request()->has('phase'), function ($query) {
                $query->where('phase', \request('phase'));
            })->where('user_type_id', 3)->search()]);
    }

    public function create()
    {
        $form = [
            "name" => '',
            "mobile_no" => '',
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    public function store(Request $request)
    {
        $model = new User();
        $model->fill($request->except('password'));
        $model->password = Hash::make($request->password);
        $model->save();
        $model->assignRole('Employee');
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function show($id)
    {
        $model = User::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    public function edit($id)
    {

        $model = User::with('usertype')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = User::findOrFail($id);
        $model->fill($request->except('password'));
        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function destroy($id)
    {
//        dd(request()->all($id));
//        dd("asas");
        $model = User::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
    public function submit_get($id){
        $model = User::findOrFail($id);
        if(  $model->phase == 0){
            $model->phase = 1;
        }
        $model->save();
        return response()->json([
            "form" => $model
        ]);
    }
    public function accept_get($id)
    {
        $model = User::findOrFail($id);
        if(  $model->phase == 1){
            $model->phase = 2;
        }
        $model->save();
        return response()->json([
            "form" => $model
        ]);
    }
    public function reject_get($id)
    {
        $model = User::findOrFail($id);
        if(  $model->phase == 1 || $model->phase == 2){
            $model->phase = 3;
        }
        $model->save();
        return response()->json([
            "form" => $model
        ]);
    }


}
