<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
//        if (!in_array('view-user', Auth::user()->getAllPermissions()->pluck('name')->toArray())) {
//            return response()->json(["status" => 0, "message" => "Authorization Error"], 422);
//        }
        return response()->json(['data' => User::with('roles')->search()]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'mobile_no' => 'required|min:10|max:15',
        ], [
            'name.required' => 'Please enter a name.',
            'email.required' => 'Please enter an email address.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Your password must be at least :min characters long.',
            'mobile_no.required' => 'Please enter a mobile number.',
            'mobile_no.min' => 'Your mobile number must be at least :min characters long.',
            'mobile_no.max' => 'Your mobile number cannot be longer than :max characters.',
        ]);

        $model = new User();
        $model->fill($request->except('password'));
        $model->password = Hash::make($request->password);
        $model->save();
        $model->assignRole('Employee');
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function show($id)
    {
        $model = User::with('eligibility', 'reference','emergency', 'bank', 'medical')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    public function edit($id)
    {

        $model = User::findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6',
            'mobile_no' => 'required|string|min:10|max:15',
        ], [
            'name.required' => 'Please enter a name.',
            'email.required' => 'Please enter an email address.',
//            'email.unique' => 'This email address is already in use.',
//            'password.required' => 'Please enter a password.',
//            'password.min' => 'Your password must be at least :min characters long.',
            'mobile_no.required' => 'Please enter a mobile number.',
            'mobile_no.min' => 'Your mobile number must be at least :min characters long.',
            'mobile_no.max' => 'Your mobile number cannot be longer than :max characters.',
        ]);
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

    public function assign_user_role(Request $request)
    {
        $admin_user = User::findOrFail($request->id);
//        $collection_roles = collect($request->roles);
//        $roles = $collection_roles->pluck('name');

//        dd($request->roles['name']);
        $admin_user->syncRoles($request->roles['name']);

        return response()->json(['saved' => true]);
    }

    public function changePassword(Request $request)
    {
        \request()->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => ['same:new_password'],
        ]);
        if (!Hash::check(\request()->old_password, auth()->user()->password)) {
            return response()->json(['error' => 'Password Not Match'], 200);
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make(\request()->new_password)
        ]);
        return response()->json(['saved' => true], 200);
    }

    public function basic_info_get($id)
    {
        $model = User::with(['city', 'country', 'nationality'])->findOrFail($id);

        return response()->json([
            "form" => $model
        ]);
    }

    public function basic_info_save(Request $request, $id)
    {
        $request->validate([
//            'name' => 'required',
        ]);
        $model = User::with(['city', 'country', 'nationality'])->findOrFail($id);
        $model->fill($request->all());
//        dd($model);
        if ($request->hasFile('imgN')) {
            $file = $request->file('imgN');

            $extension = $file[0]->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file[0]->move('uploads/basic_info/img', $filename);
            $model->img = $filename;
        }
        if ($request->hasFile('CV')) {
            $file = $request->file('CV');

            $extension = $file[0]->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file[0]->move('uploads/basic_info/file', $filename);
            $model->cv = $filename;
        }
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function submit_get($id)
    {

    }

}


