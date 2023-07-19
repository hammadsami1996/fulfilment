<?php

namespace App\Http\Controllers;

use App\Models\User_Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => User_Plan::search()]);
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
//        $request->validate([
//            'name' => 'required',
//        ]);

//dd($request->getSchemeAndHttpHost());

//
//        config(['database.connections.second_db.database' => Auth::user()->tent->tenancy_db_name]);
//
//
        $tenant_db = DB::connection('mysql')->table('user_plans')->insert([
            'user_id' => $request->id,
            'price' => $request->price,
            'plain_id' => $request->id,
            'created_at' => now(),
            'domain' => request()->getHost()
        ]);
//        $tenant_db->table('plains')->insert(['plain_id'=>$request->id]);
////        dd($tenant_db);


        $model = new User_Plan();
        $model->user_id = Auth::id();
        $model->price = $request->price;
        $model->plain_id = $request->id;
        $model->user_id = $request->id;

        $model->save();

        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function show($id)
    {
        $model = User_Plan::findOrFail($id);

        return response()->json(["data" => $model]);
    }

    public function edit($id)
    {
        $model = User_Plan::findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required',
            'plain_id' => 'required',
            'user_id' => 'required',
        ]);
        $model = User_Plan::findOrFail($id);
        $model->fill($request->all());
        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    public function destroy($id)
    {
        $model = User_Plan::findOrFail($id);
        $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }

}
