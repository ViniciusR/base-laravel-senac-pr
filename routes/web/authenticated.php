<?php
/**
 * Authenticated routes
 * Middleware 'auth'
 */

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categorias', 'CategoriaController');
Route::resource('planejamento-solicitacoes', 'PlanejamentoSolicitacaoController', ['except' => 'show']);
Route::get('planejamento-solicitacoes/{status?}', 'PlanejamentoSolicitacaoController@index')->name('planejamento-solicitacoes.index');
