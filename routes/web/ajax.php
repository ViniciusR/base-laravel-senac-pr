<?php
/**
 * Ajax routes for authenticated users.
 * Prefix 'ajax', middleware auth.
 */

Route::put('planejamento-solicitacoes.update-row/{CodSol}/{column}', 'PlanejamentoSolicitacaoController@updateRow')->name('ajax.planejamento-solicitacoes.update-row');
Route::post('planejamento-solicitacoes.update-status/{CodSol}/{status}', 'PlanejamentoSolicitacaoController@updateStatus')->name('ajax.planejamento-solicitacoes.update-status');