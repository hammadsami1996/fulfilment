<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Permission::search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "name" => '',
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
        $request->validate([
            'name' => 'required',
            'menu_id' => 'required',
        ]);
        $model = new Permission();
        $model->group= ucfirst(strtolower($request->name));
        $model->menu_id=$request->menu_id;
        $model->save();
        $arr = ['view-', 'edit-', 'create-', 'delete-', 'export-'];

        for ($i = 0; $i < 5; $i++) {
            $_model = new Permission();
            $_model->name = $arr[$i] . strtolower($request->name) ;
            $_model->group_id = $model->id;
            $_model->save();
        }
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Permission::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Permission::findOrFail($id);
        return response()->json([
            "form" => $model
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'menu_id' => 'required',
        ]);
        $model = Permission::findOrFail($id);
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
        $model = Permission::findOrFail($id);
       $model->deleted_by = Auth::id();
       $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }

    public function permission_menu()
    {
        return response()->json(['data' => Permission::whereNotNull('menu')->search()]);
    }

    public function permission_menu_post(Request $request)
    {
        $model = new Permission();
        $model->menu = ucfirst($request->name);
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }
}
