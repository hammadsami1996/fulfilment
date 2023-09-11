<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\Companysetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    //    dd(request()->all());
        $model = Companysetting::where('key' , request()->key)->first();
        return response()->json([
            "form" => json_decode($model->value)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(settings $settings)
    {
        //
    }

    public function add_settings(Request $request){
        // dd($request->all());
        $model = Companysetting::where('key' , $request['value'])->update([
            'login_id'=>$request['login_id'],
            'password'=>$request['password'],
            'value'=>json_encode($value),

            'active'=>1,
            'mask'=>$request['mask'],
        ]);
        $value=[
            'login_id'=>$request['login_id'],
            'password'=>$request['password'],
          
            'mask'=>$request['mask'],
           
        ];
        $model->key = $request['value'];
        $model->value = json_encode($value);
        $model->active = 1;
        $model->company_id = $request['company_id'];

        $model->save();
        return response()->json(['saved' => true, 'id' => $model->id
        ]);

    }
}
