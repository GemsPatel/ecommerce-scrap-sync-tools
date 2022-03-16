<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/******************* On Use *********************/

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";

 });
Auth::routes();

Route::get('test', [TestController::class, 'test'] );
Route::any('home', [HomeController::class, 'index'] )->name('home');
Route::any('dashboard', [HomeController::class, 'index'] )->name('dashboard');

Route::any('settings', [SettingsController::class, 'index'] )->name('settings');
Route::any('connectShopifyAccount', [SettingsController::class, 'connectShopifyAccount'] )->name('connectShopifyAccount');
Route::any('disconnectShopifyAccount', [SettingsController::class, 'disconnectShopifyAccount'] )->name('disconnectShopifyAccount');
Route::any('connectBrightpearlAccount', [SettingsController::class, 'connectBrightpearlAccount'] )->name('connectBrightpearlAccount');
Route::any('disconnectBrightpearlAccount', [SettingsController::class, 'disconnectBrightpearlAccount'] )->name('disconnectBrightpearlAccount');

Route::any('restartProductSync', [SettingsController::class, 'restartProductSync'] )->name('restartProductSync');

Route::any('configuration', [ConfigurationController::class, 'index'] )->name('configuration');
Route::any('save-product-setting', [ConfigurationController::class, 'save_product_setting'] )->name('save-product-setting');

Route::any('product-logs/{status?}', [LogsController::class, 'product_logs'] )->name('product-logs');
Route::any('get_product_log', [LogsController::class, 'get_product_log'] )->name('get_product_log');
Route::post('resyncProduct', [LogsController::class, 'resyncProduct'] );

/********************* end Use **********************/
// Route::any('/manage-users', 'UserController@index')->name('manage-users');
// Route::any('/user-list', 'UserController@listUser')->name('user-list');
// Route::any('/user-add', 'UserController@addUser')->name('user-add');
// Route::any('/user-delete', 'UserController@deleteUser')->name('user-delete');
// Route::any('/user-edit', 'UserController@editUser')->name('user-edit');
// Route::any('/user-update', 'UserController@updateUser')->name('user-update');

Route::any('profile-edit', [UserController::class, 'editProfile'] )->name('profile-edit');
Route::any('profile-update', [UserController::class, 'updateProfile'] )->name('profile-update');
Route::any('password-update', [UserController::class, 'updatePassword'] )->name('password-update');

Route::any('setpassword/{token}', [SetPasswordController::class, 'setPassword'] )->name('setpassword');
Route::any('save-new-password', [SetPasswordController::class, 'saveNewPassword'] )->name('save-new-password');

// Route::get('/clear-cache', function () {
// 	$exitCode = Artisan::call('cache:clear');
// 	$exitCode1 = Artisan::call('view:clear');
// 	$exitCode2 = Artisan::call('route:clear');
// 	$exitCode3 = Artisan::call('config:clear');
// 	dd($exitCode, $exitCode1, $exitCode2, $exitCode3);
//     //return redirect()->back();
// })->name('clearCache');
