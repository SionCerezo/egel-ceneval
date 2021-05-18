<?php

use App\Http\Controllers\Alumno\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Alumno;

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

//Route::get('/', LoginController::class);
Route::get('/', function(){
    return redirect('login');
});

Route::get('/home', function () {
    return view('index');
});

Auth::routes();

Route::prefix('/alumno')->name('alumno.')->namespace('App\\Http\\Controllers\\Alumno')->group(function(){
    Route::view('/', 'alumno.master')->name('home');
    Route::get('/', 'AlumnoController@home')->name('home');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
});
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@alumnoLogin');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registro',function(){
    return view('registro');
});

Route::get('/aux',function(){
    return view('auth.loginDef');
})->middleware('web');
