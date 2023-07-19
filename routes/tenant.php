<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        if (!\Illuminate\Support\Facades\Auth::check())
            return view('tenant.welcome');
        else
            return redirect('/login');
    });

//    Route::get('check-auth', function () {
//        if (!\Illuminate\Support\Facades\Auth::check())
//            return redirect()->route('login');
////    return response()->json(['authenticated' => \Illuminate\Support\Facades\Auth::check()]);
//    });

    //for auth

    Route::middleware('guest')->group(function () {
        Route::get('jobs', [\App\Http\Controllers\JobController::class, 'jobs'])->name('jobs');
        Route::get('task', function () {
            return view('tenant.task');

        })->name('task');

//        Route::get('/api/alljob', \App\Http\Controllers\JobController::class, 'all_job');
        Route::get('/api/alljob', [JobController::class, 'all_job'])->name('alljob');


        Route::get('personal_information', [RegisteredUserController::class, 'personal_informationcreate'])
            ->name('register');

        Route::get('register', [RegisteredUserController::class, 'tenantcreate'])
            ->name('register');

        Route::post('register', [RegisteredUserController::class, 'tenantstore']);

        Route::get('login', [AuthenticatedSessionController::class, 'tenantcreate'])->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'tenantstore']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.stores');
    });

    Route::middleware('auth')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });

    Route::prefix('api')->middleware(['auth', 'verified'])->group(function () {

        Route::get('city', [\App\Http\Controllers\CityController::class, 'search']);
        Route::get('country', [\App\Http\Controllers\CountryController::class, 'search']);
        Route::get('menus', [\App\Http\Controllers\MenuController::class, 'index']);
        Route::resource('user', \App\Http\Controllers\UserController::class);
        Route::resource('job', \App\Http\Controllers\JobController::class);
        Route::post('assign_user_role', [\App\Http\Controllers\UserController::class, 'assign_user_role']);
        Route::resource('role', \App\Http\Controllers\RoleController::class);
        Route::resource('permission', \App\Http\Controllers\PermissionController::class);
        Route::resource('plan', \App\Http\Controllers\PlanController::class);
        Route::resource('user_plan', \App\Http\Controllers\UserPlanController::class);
        Route::resource('user_job', \App\Http\Controllers\UserJobController::class);
        Route::resource('apply_job', \App\Http\Controllers\ApplyJobController::class);
        Route::resource('location', \App\Http\Controllers\LocationController::class);
        Route::resource('job_type', \App\Http\Controllers\JobTypeController::class);
        Route::resource('job_role', \App\Http\Controllers\JobRoleController::class);
        Route::resource('job_skill', \App\Http\Controllers\JobSkillController::class);
        Route::resource('job_speciality', \App\Http\Controllers\JobSpecialityController::class);
        Route::resource('job_user', \App\Http\Controllers\JobUserController::class);
        Route::post('change_password', [\App\Http\Controllers\UserController::class, 'changePassword']);
        Route::get('basic_info/{id}', [\App\Http\Controllers\UserController::class, 'basic_info_get']);
        Route::post('basic_info/{id}', [\App\Http\Controllers\UserController::class, 'basic_info_save']);
//        Route::put('basic_info/{id}', [\App\Http\Controllers\UserController::class, 'basic_info_save']);
        Route::get('permission_menu', [\App\Http\Controllers\PermissionController::class, 'permission_menu']);
        Route::post('permission_menu', [\App\Http\Controllers\PermissionController::class, 'permission_menu_post']);
        Route::get('eligibility_to_work/{id}', [\App\Http\Controllers\EligibilityToWorkController::class, 'eligibility_to_work_get']);
        Route::post('eligibility_to_work/{id}', [\App\Http\Controllers\EligibilityToWorkController::class, 'eligibility_to_work_save']);
        Route::get('reference/{id}', [\App\Http\Controllers\ReferenceController::class, 'reference_get']);
        Route::post('reference/{id}', [\App\Http\Controllers\ReferenceController::class, 'reference_post']);
        Route::get('emergency/{id}', [\App\Http\Controllers\EmergencyController::class, 'emergency_get']);
        Route::post('emergency/{id}', [\App\Http\Controllers\EmergencyController::class, 'emergency_post']);
        Route::get('bank/{id}', [\App\Http\Controllers\BankController::class, 'bank_get']);
        Route::post('bank/{id}', [\App\Http\Controllers\BankController::class, 'bank_post']);
        Route::get('medical/{id}', [\App\Http\Controllers\MedicalController::class, 'medical_get']);
        Route::post('medical/{id}', [\App\Http\Controllers\MedicalController::class, 'medical_post']);
        Route::get('submit/{id}', [\App\Http\Controllers\CandidateController::class, 'submit_get']);
        Route::get('accept/{id}', [\App\Http\Controllers\CandidateController::class, 'accept_get']);
        Route::get('reject/{id}', [\App\Http\Controllers\CandidateController::class, 'reject_get']);

        Route::resource('candidate', \App\Http\Controllers\CandidateController::class);
        Route::resource('user_type', \App\Http\Controllers\UserTypeController::class);
//        Route::get('submit/{id}', [\App\Http\Controllers\UserController::class, 'submit_get']);
        //fulfilment
        Route::resource('product', \App\Http\Controllers\ProductController::class);
        Route::resource('wearhouse', \App\Http\Controllers\WearhouseController::class);
        Route::resource('stores', \App\Http\Controllers\StoreController::class);
        Route::resource('company', \App\Http\Controllers\CompanyController::class);
        Route::resource('inventory', \App\Http\Controllers\InventoryController::class);
        Route::resource('supplier', \App\Http\Controllers\SupplierController::class);
        Route::resource('purchase', \App\Http\Controllers\PurchaseController::class);
        Route::resource('order', \App\Http\Controllers\OrderController::class);
        Route::resource('customer', \App\Http\Controllers\CustomerController::class);
        Route::resource('type', \App\Http\Controllers\TypeController::class);




    });


    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', function () {
            return view('layouts.app');
        });
    });
//end auth

    Route::get('{vue?}', function () {
        return view('layouts.app');
    })->where('vue', '[\/\w\.-]*')->middleware(['auth', 'verified'])->name('dashboard');
});




