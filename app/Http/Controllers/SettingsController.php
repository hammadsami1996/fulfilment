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
    $model = null;
    if(request()->key && request()->company){
        $model = Companysetting::where('key' , request()->key)->where('company_id' , request()->company)->first();

    }
    // dd($model);
        return response()->json([
            "form" =>$model ?  json_decode($model->value):['company'=>[]]
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
        $model = Companysetting::where('key' , $request['value'])->first();
        if($request['value'] == 'sms_settings'){
            $value=[
                'login_id'=>$request['login_id'],
                'password'=>$request['password'],
              
                'mask'=>$request['mask'],
               
            ];
        }
        if($request['value'] == 'email_settings'){
            $value=[
                'title'=>$request['title'],
                'host'=>$request['host'],
                'username'=>$request['username'],


                'password'=>$request['password'],
                'port'=>$request['port'],
                'smtp'=>$request['smtp'],
                'form_email'=>$request['form_email'],



              
                'value'=>$request['value'],
               
            ];
        }
       
        $model->key = $request['value'];
        $model->value = json_encode($value);
        $model->active = 1;
        $model->company_id = $request['company_id'];

        $model->save();
        return response()->json(['saved' => true, 'id' => $model->id
        ]);

    }
}
