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
    return view('inicio');
})->name('inicio');



Route::get('/incluir-novo', function () {
    return view('incluir-novo');
})->name('incluir-novo');


/* Rotas cadastros */
Route::group(['prefix' => '/cadastros'], function () {

    Route::get('/', 'CadastroController@index')->name('cadastros.index');
    Route::get('/create', 'CadastroController@create')->name('cadastros.create');
    Route::post('/store', 'CadastroController@store')->name('cadastros.store');
    Route::get('/desativar/{id}', 'CadastroController@desativar')->name('cadastro.desativar');
    Route::get('/ativar/{id}', 'CadastroController@ativar')->name('cadastro.ativar');
    Route::get('/add-dependente/{id}', 'CadastroController@ativar')->name('cadastro.add-dependente');
//    Route::delete('/destroy/{id}', 'FichaCadastralController@destroy')->name('destroy');
//    Route::get('/edit/{id}', 'FichaCadastralController@edit')->name('edit');
//    Route::post('/update/{id}', 'FichaCadastralController@update')->name('update');

});
/* Rotas cadastros */
