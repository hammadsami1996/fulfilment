<?php

namespace App\Http\Controllers;

use App\Models\Permission as PermissionCustom;
use App\Models\Role as RoleCustom;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
//        dd( Auth::user()->getAllPermissions()->pluck('name')->toArray());
//        if (!in_array('view-role', Auth::user()->getAllPermissions()->pluck('name')->toArray())) {
//            return response()->json(["status" => 0, "message" => "Authorization Error"], 422);
//        }
        return response()->json(['data' => RoleCustom::search()]);

    }

    public function create()
    {
//        if (!in_array('create-roles', Auth::user()->getAllPermissions()->pluck('name')->toArray())) {
//            return response()->json(["status" => 0, "message" => "Authorization Error"], 422);
//        }
        $form = [
            "name" => '',
        ];

        $permissions = PermissionCustom::with('menus')->whereNotNull('menu')->get();

        return response()->json([
            'form' => $form,
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
//        $model = new Role();
        // for tenant DB
        $model = new \App\Models\Role();
        $model->fill($request->except('permissions'));
        $model->guard_name = 'web';
        $model->save();

//        $model->syncPermissions($request->selectedPermissions);

        // for tenant DB
        $permission = Permission::whereIn('name', $request->selectedPermissions)->pluck('id')->toArray();
        $model->permissionss()->sync($permission);

        // assign selected permissions to the role
//        $permissions = $request->input('selectedPermissions', []);
//
//        $model->permissions()->sync($permissions);

        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function show($id)
    {
        $model = Role::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    public function edit($id)
    {


//        $model = Role::findOrFail($id);
//        $model['permissions'] = $model->permissions()->pluck('name')->toArray();
//        $permissions = PermissionCustom::with('menus')->whereNotNull('menu')->get();

        $model = \App\Models\Role::findOrFail($id);
        $model['permissions'] = $model->permission()->pluck('name')->toArray();
        $permissions = PermissionCustom::with('menus')->whereNotNull('menu')->get();
        return response()->json([
            "form" => $model, 'permissions' => $permissions
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
//        $model = Role::findOrFail($id);
        // for tenant DB
        $model = \App\Models\Role::findOrFail($id);
        $model->fill($request->except('permissions'));
        $model->guard_name = 'web';
        $model->save();

//        $model->syncPermissions($request->selectedPermissions);

        // for tenant DB
        $permission = Permission::whereIn('name', $request->selectedPermissions)->pluck('id')->toArray();
        $model->permissionss()->sync($permission);

        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function destroy($id)
    {
        $model = Role::findOrFail($id);

        // Detach all permissions
        $model->permissions()->detach();

        // Detach all users
//        $model->detach();

        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
