<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConvocatoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes for Administrator users
|--------------------------------------------------------------------------
*/

Route::get('/', 'App\Http\Controllers\AdminController@home')->name('home');

Route::get('/convocatoria/active', 'App\Http\Controllers\AdminController@retrieveConvovatorias')
    ->name('convocatoria.active');

Route::resource('convocatoria', ConvocatoriaController::class);

Route::get('/convocatoria/{id}/status/{status}', 'App\Http\Controllers\ConvocatoriaController@updateStatus')
    ->name('convocatoria.update.status');
