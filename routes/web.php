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




Route::resource('/','App\Http\Controllers\estudianteController');

Route::resource('/estudiante/registro','App\Http\Controllers\perfilController');



Route::resource('/estudiante/registrarse','App\Http\Controllers\estudianteController');

Route::get('/download/{id}' , 'App\Http\Controllers\estudianteController@downloadFile')->name('downloadfile');

Route::post('/gusto' , 'App\Http\Controllers\estudianteController@gusto');

Route::post('/buscar','App\Http\Controllers\BuscarController@store');


// acceso a los usuario 



Auth::routes();

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    //

    Route::resource('/admin','App\Http\Controllers\RecursoController');

    Route::resource('/usuarios','App\Http\Controllers\UserController');

   
});


Route::group(['middleware' => ['role:estudiante']], function () {
    //

    Route::resource('/estudiante/recurso','App\Http\Controllers\estudianteController');

    Route::resource('/estudiante/perfil','App\Http\Controllers\estudianteController');


});
