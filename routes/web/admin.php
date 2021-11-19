<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConvocatoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes for Administrator users
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', 'App\Http\Controllers\AdminController@home')->name('home');

    Route::get('/convocatoria/active', 'App\Http\Controllers\AdminController@retrieveConvovatorias')
        ->name('convocatoria.active');

    Route::resource('convocatoria', ConvocatoriaController::class);
    Route::get('/convocatoria/{id}/status/{status}', 'App\Http\Controllers\ConvocatoriaController@updateStatus')
        ->name('convocatoria.update.status');
    // Route::get('/convocatorias/create', 'ConvocatoriaController@create')->name('convocatoria.create');


// });
