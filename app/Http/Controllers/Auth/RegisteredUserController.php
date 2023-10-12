<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function tenantcreate()
    {
        return view('tenant.register');
    }

    public function tenantstore(Request $request)
    {
        $request->validate(
            [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'password.required' => 'The password field is required.',
                'mobile_no' => ['required', 'numeric', 'digits:11'],
            ]
        );
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'user_type_id' => 3,
            'phase' => 0,
            'password' => Hash::make($request->password)
        ]);
//        $user->assignRole('Candidate');

        event(new Registered($user));
        Auth::login($user);
        return redirect('/dashboard');
    }

    public function personal_informationcreate()
    {
        return view('tenant.personal_information');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile_no' => ['required', 'numeric', 'digits:11'],
        ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile_no' => $request->mobile_no,
            ]);
            $tenant = Tenant::create(['id' => $request->name]);
            $tenant->domains()->create(['domain' => $request->name . env('DOMAIN')]);
            $query = "insert into users (name,email,password) values('" . $request->name . "','" . $request->email . "','" . Hash::make($request->password) . "')";
            tenancy()->initialize($tenant);
            //Create the same user in tenant DB
            Settings::create([
                'key' => 'company_name',
                'value' => $request->name,
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_type_id' => 1,
                'phase' => 0,
                'mobile_no' => $request->mobile_no,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('Admin');
            //Create the same user in tenant DB
//        $user = Settings::create([
//            'key' => 'company_name',
//            'value' => $request->name,
//        ]);

//        $model = new Settings();
//        $model->key = $request->key;
//        $model->value = $request->value;
//
//        $model->save();

            // $tenant->run(function($query) {
            //     DB::insert($query);
            //     // User::create([
            //     //     'name' => $form->name,
            //     //     'email' => $form->email,
            //     //     'password' => Hash::make($form->password),
            //     // ]);
            // });

            event(new Registered($user));

//            Auth::login($user);

        return redirect('http://' . $request->name . \env('DOMAIN'));
        // return redirect(RouteServiceProvider::HOME);
    }
}
