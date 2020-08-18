<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'TerritoriosController@listarTerritorios')->name('form_listar_territorios');
Route::get('/home', 'TerritoriosController@listarTerritorios');

Route::get('/criar', 'TerritoriosController@create')->name('form_criar_territorio');
Route::post('/criar', 'TerritoriosController@store')->name('form_gravar_territorio');
Route::get('/territorio/{id}/edit', 'TerritoriosController@edit')->name('form_editar_territorio');
Route::post('/territorio/{id}/edit', 'TerritoriosController@update')->name('form_atualizar_territorio');
Route::get('/territorios/apagar/{territorioId}', 'TerritoriosController@destroy');

Route::get('/territorios/{territorioId}', 'TelefoneController@show')->name('form_listar_telefones');
Route::get('/telefone/criar/{territorioId}', 'TelefoneController@create')->name('form_criar_telefone');
Route::post('/telefone/criar/{territorioId}', 'TelefoneController@store')->name('form_gravar_telefone');
Route::get('/telefone/editar/{telefoneId}', 'TelefoneController@edit')->name('form_editar_telefone');
Route::post('/telefone/editar/{telefoneId}', 'TelefoneController@update')->name('form_editar_telefone');

// IMPRIMIR TERRITORIO
Route::get('/territorio/imprimir/{territorioId}', 'TerritoriosController@print')->name('form_imprimir_territorio');

//Auth::routes();

Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});



//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')->name('form_entrar');
Route::post('/entrar', 'EntrarController@entrar');


// Habilitar botão Registrar 
Route::get('/registrar', 'RegistroController@create')->name('form_registrar');
Route::post('/registrar', 'RegistroController@store');
