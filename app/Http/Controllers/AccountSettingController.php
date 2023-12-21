<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AccountSetting;

class AccountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return response()->json(['data' => AccountSetting::with('account')->search()]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "key" => '',
            "value" => null,
           
        ];
        return response()->json(['form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
        
        ]);
         $model = new AccountSetting();
         $model->fill($request->all());
         $model->save();
         return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = AccountSetting::with('account')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = AccountSetting::with('account')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = AccountSetting::with('account')->findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = AccountSetting::with('account')->findOrFail($id);
        $account->delete();
        return response()->json(['deleted' => true]);
    }
}
