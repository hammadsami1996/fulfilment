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
        Route::post('assign_user_role', [\App\Http\Controllers\UserController::class, 'assign_user_role']);
        Route::resource('role', \App\Http\Controllers\RoleController::class);
        Route::resource('permission', \App\Http\Controllers\PermissionController::class);
        Route::resource('plan', \App\Http\Controllers\PlanController::class);
        Route::resource('user_plan', \App\Http\Controllers\UserPlanController::class);
        Route::post('change_password', [\App\Http\Controllers\UserController::class, 'changePassword']);
        Route::get('basic_info/{id}', [\App\Http\Controllers\UserController::class, 'basic_info_get']);
        Route::post('basic_info/{id}', [\App\Http\Controllers\UserController::class, 'basic_info_save']);
        Route::get('permission_menu', [\App\Http\Controllers\PermissionController::class, 'permission_menu']);
        Route::post('permission_menu', [\App\Http\Controllers\PermissionController::class, 'permission_menu_post']);

        Route::post('update', [\App\Http\Controllers\DeliverystatusController::class, 'updatestatus']);
        Route::post('global_settings', [\App\Http\Controllers\SettingsController::class, 'add_settings']);

        Route::post('updated', [\App\Http\Controllers\DeliverystatusController::class, 'updatedstatus']);
        Route::get('purchases', [\App\Http\Controllers\PurchaseController::class, 'index']);
        Route::get('wordpress', [\App\Http\Controllers\WordpressController::class, 'getWooCommerceOrders']);

        



        // Route::get('status', [\App\Http\Controllers\OrderController::class, 'delivery']);


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
        Route::resource('receive_order', \App\Http\Controllers\ReceiveOrderController::class);
        Route::resource('accounts_class_types', \App\Http\Controllers\AccountClassTypeController::class);
        Route::resource('accounts_class', \App\Http\Controllers\AccountClassController::class);
        Route::resource('accounts_group', \App\Http\Controllers\AccountGroupController::class);
        Route::resource('accounts', \App\Http\Controllers\AccountController::class);
        Route::resource('settings', \App\Http\Controllers\SettingsController::class);





        Route::post('receive_order_inventory', [\App\Http\Controllers\ReceiveOrderController::class, 'inventory']);
        Route::post('remianing', [\App\Http\Controllers\OrderController::class, 'remain']);

        Route::get('sts', [\App\Http\Controllers\DeliverystatusController::class, 'searches']);
        Route::get('required_stock', [\App\Http\Controllers\ReportController::class, 'required']);
        Route::get('download_images', [\App\Http\Controllers\ProductController::class, 'download_images']);
        Route::get('product_details', [\App\Http\Controllers\OrderController::class, 'details']);
        Route::get('get_delivery_charges/{id}', [\App\Http\Controllers\OrderController::class, 'get_delivery_charges']);


        // Route::get('uploads/{filename}', [\App\Http\Controllers\ProductController::class, 'showAttachment']);

        Route::resource('order', \App\Http\Controllers\OrderController::class);
        Route::resource('customer', \App\Http\Controllers\CustomerController::class);
        Route::resource('type', \App\Http\Controllers\TypeController::class);
        Route::resource('status', \App\Http\Controllers\DeliverystatusController::class);
        Route::resource('category', \App\Http\Controllers\CategoryController::class);
        Route::resource('product_category', \App\Http\Controllers\ProductCategoryController::class);
        Route::resource('brand', \App\Http\Controllers\BrandController::class);
        Route::resource('shipped', \App\Http\Controllers\ShippedController::class);
        Route::resource('order_type', \App\Http\Controllers\OrderTypeController::class);

//        Route::get('replacement_get', \App\Http\Controllers\OrderController::class, 'replacement');
//        Route::post('replacement_post', \App\Http\Controllers\OrderController::class, 'replacement_post');



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




