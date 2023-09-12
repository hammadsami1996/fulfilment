<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\MyMail;
use Twilio\Rest\Client;
use App\Models\settings;
use App\Models\Mailtemplate;
use Illuminate\Http\Request;
use App\Models\Companysetting;
use Illuminate\Support\Facades\Mail;


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
        $model = Companysetting::where('key' , $request['value'])->where('company_id' , $request['company_id'])->first();
        // dd($model);
        $model ? $model : $model = new Companysetting;
        // dd($model);
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
        $this->sendmail();
        return response()->json(['saved' => true, 'id' => $model->id
        ]);
     

    }
    
    public function sendmail(){

        $id= 1;
        $template = Mailtemplate::findOrFail($id);
        $data = [
            "template" => [
                "subject" => $template['subject'],
                "content" => $template['content'],
            ],
            "cc" => 'nazar@mimsoft.pk',
            "email" =>'nazar@mimsoft.pk',
        ];
        // $data = [
       
        //         "subject" => 'hello world',
        //         "content" => 'testing mail',
           
           
        //     "email" => 'nazar@mimsoft.pk',
        // ];
           
        Mail::to($data['email'])->send(new MyMail($data));
        return response()->json(['Email sent successfully']);
    }


    public function sendSMS(Request $request)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

        $client = new Client($twilioSid, $twilioAuthToken);

        $to = $request->input('to'); 
        $message = $request->input('message');

        try {
            $client->messages->create($to, [
                'from' => $twilioPhoneNumber,
                'body' => $message,
            ]);

            return "SMS sent successfully!";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
