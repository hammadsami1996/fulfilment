<?php

namespace App\Http\Controllers;

use App\Models\User_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => User_type::search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "user_type" => '',
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new User_type();
        $model->fill($request->all());
//        $model->created_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = User_type::findOrFail($id);
        return response()->json(["data" => $model]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = User_type::findOrFail($id);
        return response()->json([
            "form" => $model
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = User_type::findOrFail($id);
        $model->fill($request->all());
        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = User_type::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
