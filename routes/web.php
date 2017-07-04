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



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace'=>'Admin\\'

], function (){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@Login');

    Route::group(['middleware'=>'can:admin'], function(){
        Route::post('logout', 'Auth\LoginController@Logout')->name('logout');
        Route::get('dashboard', function(){
            return "Area administrativa funcionando";
        });
    });

});

Route::get('/force-login', function () {
    Auth::LoginUsingId(1);
});