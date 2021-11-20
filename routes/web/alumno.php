<?php

use App\Http\Controllers\Alumno\AlumnoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes for Alumn users
|--------------------------------------------------------------------------
|
*/
Route::namespace('Alumno')->group(function(){
    Route::get('/', 'AlumnoController@home')->name('home');

    Route::get('/postulacion', 'AlumnoController@activePostulation')->name('postulacion');

    Route::get('/{id}/edit',[AlumnoController::class,'edit'])->name('edit');
    Route::put('/{id}/update',[AlumnoController::class,'update'])->name('update');
});

/**
 * * POSTULACIONES
*/
Route::resource('/postulacion', PostulacionController::class)->only('store');
Route::get('/postulacion/create/{conv_id}', 'PostulacionController@create')
    ->name('postulacion.create');
