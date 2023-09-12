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
        $this->sendmail($model->id);
        // $this->sendSMS();

        // return response()->json(['saved' => true, 'id' => $model->id
        // ]);
     

    }
    
    public function sendmail($model){

        $id= 1;
        $email = Companysetting::findOrFail($model);
        $emails = json_decode($email->value);
        // dd($emails->username);
        $template = Mailtemplate::findOrFail($id);
        $data = [
            "template" => [
                "subject" => $template['subject'],
                "content" => $template['content'],
            ],
            "from_email" => $emails->form_email,
            "email" =>$emails->username,
        ];
        // $data = [
       
        //         "subject" => 'hello world',
        //         "content" => 'testing mail',
           
           
        //     "email" => 'nazar@mimsoft.pk',
        // ];
           
        Mail::to($data['email'])->send(new MyMail($data));
        return response()->json(['Email sent successfully']);
    }


    public function sendSMS()
    {

        $sid    = "ACbe1685f4dd8a33984d4255bc19f9eda9";
        // $sid    = 'welcome';

        $token  = env('TWILIO_AUTH_TOKEN');
        

        $twilio = new Client($sid, $token);
        $to = '+923420022843'; 
        // $message = $twilio->messages
        //   ->create("+923420022843", // to
        //     array(
        //       "from" => "+19722771946",
        //       "body" => "testing api"
        //     )
        //   );
          $message = $twilio->messages->create($to, [
            "from" => "+19722771946",
            "body" => "testing sms api"
                ]);
        //   return "SMS sent successfully!" ;
    print($message->sid);
        
        // $twilioSid = env('TWILIO_SID');
        // $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        // $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
        
        // $client = new Client($twilioSid, $twilioAuthToken);

        // $to = '03420022843'; 
        // $message = 'this is testing sms';

        // try {
            
        //     $client->messages->create($to, [
        //         'from' => $twilioPhoneNumber,
        //         'body' => $message,
        //     ]);

        //     return response()->json(["SMS sent successfully!"]) ;
        // } catch (Exception $e) {
        //     dd('abcd');
        //     return "Error: " . $e->getMessage();
        // }
    }
}
