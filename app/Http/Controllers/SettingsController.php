<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use App\Models\CompanySetting;
use App\Models\Mailtemplate;
use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


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
    $key = request()->key;
    $company_id = request()->company_id;
    // $courier = request()->input('courier');

        $model = $key && $company_id
            ? CompanySetting::where('key', $key)->where('company_id', $company_id)
            : null;
        $model = \request()->count == 'one' ? $model->first() : $model->get();
        if (\request()->count == 'All') {
            $model->map(function ($item) {
                return $item->value = json_decode($item->value, true);
            });
        } else{
            $model = $model ? json_decode($model->value, true) : false;
        }

//        $form = $model ? json_decode($model->value, true) : [];

    return response()->json([
        "form" => $model,
//        "status" => $model,
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

    public function add_settings(Request $request)
    {
        $key = $request->input('value');
        $company_id = $request->input('company_id');

        $model = CompanySetting::where('key', $key)
            ->where('company_id', $company_id)
            ->first();

        if (!$model) {
            $model = new CompanySetting;
        }

        $value = [];

        if ($key === 'sms_settings') {
            $value = [
                'login_id' => $request->input('login_id'),
                'password' => $request->input('password'),
                'mask' => $request->input('mask'),
                'url' => $request->input('url'),
            ];
        } elseif ($key === 'email_settings') {
            $value = [
                'title' => $request->input('title'),
                'host' => $request->input('host'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'port' => $request->input('port'),
                'smtp' => $request->input('smtp'),
                'form_email' => $request->input('form_email'),
                'value' => $key,
            ];
        }

        $model->key = $key;
        $model->value = json_encode($value);
        $model->active = 1;
        $model->company_id = $company_id;

        $model->save();

        return response()->json(['saved' => true, 'id' => $model->id]);
    }


    public function other_setting(Request $request) {

        $courier_id = $request->data['id'];

        $existingSetting = CompanySetting::where('key', $request->key)
            ->where('company_id', $request->company_id)
            ->whereJsonContains('value->id', $courier_id)
            ->first();

        if (!$existingSetting) {
            $existingSetting = new CompanySetting;
            $existingSetting->key = $request->key;
        }
        $existingSetting->value = json_encode([
                'id' => $request->data['id'],
                'name' => $request->data['name'],
                'authentication_key' => $request->data['authentication_key'],
            ]);
        $existingSetting->active = $request->data['active'] ?? 0;
        $existingSetting->company_id = $request->company_id;
        $existingSetting->save();
        return response()->json(['saved' => true, 'id' => $existingSetting->id]);
    }
    public function sendmail($model){

        $id= 1;
        $email = CompanySetting::findOrFail($model);
        $emails = json_decode($email->value);
        $smtp_encryption = 'tls,';
        // dd($emails->username);
        Config::set('mail.driver', 'smtp');
        Config::set('mail.host', $emails->host);
        Config::set('mail.port', $emails->port);
        Config::set('mail.encryption', $smtp_encryption);
        Config::set('mail.username', $emails->username);
        Config::set('mail.password', $emails->password);
        Config::set('mail.from.address', $emails->form_email);
        // Config::set('mail.from.name', $emails->title);

        $template = Mailtemplate::findOrFail($id);
        $data = [
            "template" => [
                "subject" => $template['subject'],
                "content" => $template['content'],
            ],
            "from_email" => $emails->form_email,
            "email" =>'nazar@mimsoft.pk',
            "title" => $emails->title,
        ];

        Mail::to($data['email'])->send(new MyMail($data));
        return response()->json(['Email sent successfully']);
    }

    public function sendSMS($id)
    {
        $sms = CompanySetting::findOrFail($id);
        $sms2 = json_decode($sms->value);
        $sid = $sms2->login_id;
        // $sid    = "ACbe1685f4dd8a33984d4255bc19f9eda9";
        // $sid    = 'welcome';
        $token = $sms2->password;
        // $token  = env('TWILIO_AUTH_TOKEN');


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
