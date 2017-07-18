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

Route::get('/', function () {
    return view('welcome');
});
/*
//registration routes
$this->get('register','Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register','Auth\RegisterController@register')->name('register');*/

//password reset routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@Reset');

Route::get('email-verification/error', 'EmailVerificationController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'EmailVerificationController@getVerification')->name('email-verification.check');

Route::get('/home','HomeController@index');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace'=>'Admin\\'

], function (){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@Login');

    Route::group(['middleware'=>['isVerified','can:admin']], function(){
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('dashboard', function(){
            return view('admin.dashboard');
        });
        Route::put('users/settings','Auth\UserSettingsController@update')->name('user_settings.update');
        Route::get('users/settings','Auth\UserSettingsController@edit')->name('user_settings.edit');
        Route::resource('users','UsersController');
        Route::resource('categories','CategoriesController');
    });
});

Route::get('/force-login', function () {
    Auth::LoginUsingId(1);
});