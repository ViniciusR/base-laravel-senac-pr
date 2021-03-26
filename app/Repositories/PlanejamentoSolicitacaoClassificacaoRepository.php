<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PlanejamentoSolicitacaoClassificacao;
use App\Repositories\Repository;

class PlanejamentoSolicitacaoClassificacaoRepository extends Repository
{
    protected function getClass()
    {
        return PlanejamentoSolicitacaoClassificacao::class;
    }

    public function PlanejamentoSolicitacaoClassificacao_IU($data)
    {   
        try {
            $queryResult = DB::select("exec PlanejamentoSolicitacaoClassificacao_IU ?, ?", [
                    \Arr::get($data, 'CodClass', null), 
                    \Arr::get($data, 'Nome', null),
                ]);
            
            return (int) $queryResult[0]->CodSol;
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoClassificacao_S($CodClass = null)
    {   
        try {
            $classificacoes = new PlanejamentoSolicitacaoClassificacao();

            $classificacoes = $classificacoes->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoClassificacao_S ?", [
                    $CodClass
                ])
            );
            return $classificacoes;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoClassificacao_P($data)
    {   
        try {
            $classificacoes = new PlanejamentoSolicitacaoClassificacao();

            $classificacoes = $classificacoes->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoClassificacao_P ?", [
                    \Arr::get($data, 'Pesquisa', null), 
                ])
            );
            return $classificacoes;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }
    
    public function PlanejamentoSolicitacaoClassificacao_D($CodClass)
    {   
        try {
            DB::update("exec PlanejamentoSolicitacaoClassificacao_D ?", [
                $CodClass
            ]);

            return true;   
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function toSelect()
    {
        $classificacoes = $this->PlanejamentoSolicitacaoClassificacao_S()
            ->map(function ($classificacao) {
                return [
                    'id' => $classificacao['CodClass'],
                    'label' => $classificacao['Nome']
                ];
            });

        return $classificacoes->toArray();
    }
}