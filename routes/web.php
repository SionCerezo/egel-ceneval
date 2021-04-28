<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('index');
});

Route::get('/layout', function () {
    return view('master');
});

Auth::routes();

Route::prefix('/alumno')->name('alumno.')->namespace('App\\Http\\Controllers\\Alumno\\Auth')->group(function(){
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
