<?php

use App\Http\Controllers\Alumno\AlumnoController;
use App\Http\Controllers\ConvocatoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostulacionController;
use App\Models\Alumno;
use App\Models\Convocatoria;
use Illuminate\Support\Facades\Storage;

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

    Route::get('/convocatoria/active', 'App\Http\Controllers\AdminController@retrieveConvovatorias')
        ->name('convocatoria.active');

    Route::resource('convocatoria', ConvocatoriaController::class);
    Route::get('/convocatoria/{id}/status/{status}', 'App\Http\Controllers\ConvocatoriaController@updateStatus')
        ->name('convocatoria.update.status');
    // Route::get('/convocatorias/create', 'ConvocatoriaController@create')->name('convocatoria.create');


});

Route::prefix('/alumno')->name('alumno.')->namespace('App\\Http\\Controllers\\Alumno')->group(function(){
    Route::view('/', 'alumno.master')->name('home');
    Route::get('/', 'AlumnoController@home')->name('home');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');

    Route::get('/postulacion', 'AlumnoController@activePostulation')
        ->name('postulacion');
});
// Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

// POSTULACIONES
// Route::resource('/postulacion', PostulacionController::class)->except('create');
// Route::get('/postulacion/create/{conv_id}', 'App\Http\Controllers\PostulacionController@create')
//     ->name('postulacion.create');
// Route::get('/postulacion/{conv_id}/download-files', 'App\Http\Controllers\PostulacionController@create')
// ->name('postulacion.create');

Route::resource('/postulacion', PostulacionController::class)->except('create');
Route::prefix('/postulacion')->name('postulacion.')->namespace('App\\Http\\Controllers')->group(function(){
    Route::get('/create/{conv_id}', 'PostulacionController@create')
        ->name('create');
    Route::get('/{postulacion}/download-files', 'PostulacionController@downloadFiles')
        ->name('download-files');
});

// FILES
Route::get('/files/{file_id}', function ($file_id){
    // dump($file_id);
    // dump(PostulacionController::STORE_PATH . $file_id);
    return Storage::response($file_id);
})->name('file.response')->where('file_id', '.*');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/registro',function(){
//     return view('registro');
// });


Route::get('/aux',function(){
    return view('ejempo');
})->middleware('web')->name('aux');

// Route::get('/ajax',function(){
//     return view('ajax');
// });
