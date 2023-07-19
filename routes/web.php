<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('check-auth', function () {
//    if (!\Illuminate\Support\Facades\Auth::check())
//        return redirect()->route('login');
////    return response()->json(['authenticated' => \Illuminate\Support\Facades\Auth::check()]);
//});

Route::middleware('auth')->group(function () {

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', function () {
            return view('layouts.app');
        });
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('api')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('permission', \App\Http\Controllers\PermissionController::class);
    Route::get('permission_menu', [\App\Http\Controllers\PermissionController::class, 'permission_menu']);
    Route::post('permission_menu', [\App\Http\Controllers\PermissionController::class, 'permission_menu_post']);
    Route::get('city', [\App\Http\Controllers\CityController::class, 'search']);
    Route::get('country', [\App\Http\Controllers\CountryController::class, 'search']);
    Route::get('menus', [\App\Http\Controllers\MenuController::class, 'index']);
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::post('assign_user_role', [\App\Http\Controllers\UserController::class, 'assign_user_role']);
    Route::get('basic_info', [\App\Http\Controllers\UserController::class, 'basic_info_get']);
    Route::post('basic_info', [\App\Http\Controllers\UserController::class, 'basic_info_save']);
    Route::post('change_password', [\App\Http\Controllers\UserController::class, 'changePassword']);
    Route::resource('role', \App\Http\Controllers\RoleController::class);
    Route::resource('permission', \App\Http\Controllers\PermissionController::class);
    Route::resource('plan', \App\Http\Controllers\PlanController::class);
    Route::resource('user_plan', \App\Http\Controllers\UserPlanController::class);
    Route::get('submit/{id}', [\App\Http\Controllers\CandidateController::class, 'submit_get']);
    Route::get('accept/{id}', [\App\Http\Controllers\CandidateController::class, 'accept_get']);
    Route::get('reject/{id}', [\App\Http\Controllers\CandidateController::class, 'reject_get']);
    Route::resource('candidate', \App\Http\Controllers\CandidateController::class);
    Route::resource('user_type', \App\Http\Controllers\UserTypeController::class);
    //fulfilment
    Route::resource('product', \App\Http\Controllers\ProductController::class);


});

Route::get('plan', [\App\Http\Controllers\PlanController::class, 'plan'])->name('plan');
Route::get('task', [\App\Http\Controllers\PlanController::class, 'task'])->name('task');


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//Route::get('/manage', function () {
//    return view('manage');
//})->middleware(['auth', 'verified'])->name('manage');
//Route::get('/client', function () {
//    return view('client');
//})->middleware(['auth', 'verified'])->name('client');
//Route::get('/task', function () {
//    return view('task');
//})->middleware(['auth', 'verified'])->name('task');

require __DIR__ . '/auth.php';

//Auth::routes();

Route::get('{vue?}', function () {
    return view('layouts.app');
})->where('vue', '[\/\w\.-]*')->middleware(['auth', 'verified'])->name('dashboard');


