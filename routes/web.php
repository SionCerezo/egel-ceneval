<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulacionController;
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

Route::get('/', function(){
    return redirect('login');
});

Auth::routes();

/**
 * * REGISTRO
 */
Route::prefix('/alumno')->name('alumno.')->namespace('App\\Http\\Controllers\\Alumno')->group(function(){
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
});

/**
 * * POSTULACIONES
 */
Route::resource('/postulacion', PostulacionController::class)->except(['create','store']);
Route::prefix('/postulacion')->name('postulacion.')->namespace('App\\Http\\Controllers')->group(function(){
    Route::get('/{postulacion}/download-files', 'PostulacionController@downloadFiles')
        ->name('download-files');
});

/**
 * * FILES
 */
Route::get('/files/{file_id}', function ($file_id){
    // dump($file_id);
    // dump(PostulacionController::STORE_PATH . $file_id);
    return Storage::response($file_id);
})->name('file.response')->where('file_id', '.*');

/**
 * ! Rutas de ayuda, eliminarlas al final
 */
Route::get('/aux',function(){
    return view('ejempo');
})->middleware('web')->name('aux');

Route::get('/close',function(){
    return view('close-sesion');
});
