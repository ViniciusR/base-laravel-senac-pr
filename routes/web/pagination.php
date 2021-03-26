<?php
/**
 * Authenticated routes
 * Middleware 'auth', 'web'
 * Prefix pagination
 */

Route::get('categorias', 'CategoriaController@pagination')->name('pagination.categorias');
Route::get('planejamento-solicitacoes/{status?}', 'PlanejamentoSolicitacaoController@pagination')->name('pagination.planejamento-solicitacoes');