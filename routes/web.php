<?php

use App\Http\Controllers\Alumno\AlumnoController;
use App\Http\Controllers\ConvocatoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Alumno;
use App\Models\Convocatoria;

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

// Route::get('/home', function () {
//     return view('index');
// });

// Route::resource('convocatoria', ConvocatoriaController::class);
Auth::routes();

Route::prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', 'App\Http\Controllers\AdminController@home')->name('home');

    Route::get('/convocatorias', 'App\Http\Controllers\AdminController@retrieveConvovatorias')
        ->name('convocatorias');
    // Route::get('/convocatorias/create', 'ConvocatoriaController@create')->name('convocatoria.create');
    Route::resource('convocatoria', ConvocatoriaController::class);
});

Route::prefix('/alumno')->name('alumno.')->namespace('App\\Http\\Controllers\\Alumno')->group(function(){
    Route::view('/', 'alumno.master')->name('home');
    Route::get('/', 'AlumnoController@home')->name('home');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
});
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/registro',function(){
//     return view('registro');
// });


Route::get('/aux',function(){
    return 'aux';
})->middleware('web')->name('aux');
