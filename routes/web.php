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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {

    Route::get('/estoque', "App\Http\Controllers\EstoqueController@index");
    Route::get('/estoque/create', "App\Http\Controllers\EstoqueController@create");
    Route::post('/estoque/store', "App\Http\Controllers\EstoqueController@store");
    Route::get('/estoque/move/{id}', "App\Http\Controllers\EstoqueController@move");
    Route::get('/estoque/edit/{id}', "App\Http\Controllers\EstoqueController@edit");
    Route::post('/estoque/update/{id}', "App\Http\Controllers\EstoqueController@update");
    Route::get('/estoque/show/{id}', "App\Http\Controllers\EstoqueController@show");
    Route::get('/estoque/destroy/{id}', "App\Http\Controllers\EstoqueController@destroy");
    Route::post('/estoque/search/', "App\Http\Controllers\EstoqueController@search");
    Route::get('/estoque-relatorio', "App\Http\Controllers\EstoqueController@gerarEstoquePDF");

    Route::get('/estoque-email', "App\Http\Controllers\EstoqueController@sendEmail");

    Route::get('/venda', "App\Http\Controllers\VendaController@index");
    Route::get('/venda/create', "App\Http\Controllers\VendaController@create");
    Route::post('/venda/store', "App\Http\Controllers\VendaController@store");
    Route::get('/venda/edit/{id}', "App\Http\Controllers\VendaController@edit");
    Route::post('/venda/update/{id}', "App\Http\Controllers\VendaController@update");
    Route::get('/venda/show/{id}', "App\Http\Controllers\VendaController@show");
    Route::get('/venda/destroy/{id}', "App\Http\Controllers\VendaController@destroy");
    Route::post('/venda/search/', "App\Http\Controllers\VendaController@search");
    Route::get('/venda-relatorio', "App\Http\Controllers\VendaController@gerarVendaPDF");

    Route::get('/fornecedor', "App\Http\Controllers\FornecedorController@index");
    Route::get('/fornecedor/create', "App\Http\Controllers\FornecedorController@create");
    Route::post('/fornecedor/store', "App\Http\Controllers\FornecedorController@store");
    Route::get('/fornecedor/edit/{id}', "App\Http\Controllers\FornecedorController@edit");
    Route::post('/fornecedor/update/{id}', "App\Http\Controllers\FornecedorController@update");
    Route::get('/fornecedor/show/{id}', "App\Http\Controllers\FornecedorController@show");
    Route::get('/fornecedor/destroy/{id}', "App\Http\Controllers\FornecedorController@destroy");
    Route::post('/fornecedor/search/', "App\Http\Controllers\FornecedorController@search");
    Route::get('/fornecedor-relatorio', "App\Http\Controllers\FornecedorController@gerarFornecedorPDF");

});
