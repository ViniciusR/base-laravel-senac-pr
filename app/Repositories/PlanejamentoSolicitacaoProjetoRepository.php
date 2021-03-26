<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PlanejamentoSolicitacaoProjeto;
use App\Repositories\Repository;

class PlanejamentoSolicitacaoProjetoRepository extends Repository
{
    protected function getClass()
    {
        return PlanejamentoSolicitacaoProjeto::class;
    }

    public function PlanejamentoSolicitacaoProjeto_IU($data)
    {   
        try {
            $queryResult = DB::select("exec PlanejamentoSolicitacaoProjeto_IU ?, ?", [
                    \Arr::get($data, 'CodProj', null), 
                    \Arr::get($data, 'Nome', null),
                ]);
            
            return (int) $queryResult[0]->CodSol;
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoProjeto_S($CodProj = null)
    {   
        try {
            $projetos = new PlanejamentoSolicitacaoProjeto();

            $projetos = $projetos->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoProjeto_S ?", [
                    $CodProj
                ])
            );
            return $projetos;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();;
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoProjeto_P($data)
    {   
        try {
            $projetos = new PlanejamentoSolicitacaoProjeto();

            $projetos = $projetos->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoProjeto_P ?", [
                    \Arr::get($data, 'Pesquisa', null), 
                ])
            );
            return $projetos;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }
    
    public function PlanejamentoSolicitacaoProjeto_D($CodProj)
    {   
        try {
            DB::update("exec PlanejamentoSolicitacaoProjeto_D ?", [
                $CodProj
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
        $projetos = $this->PlanejamentoSolicitacaoProjeto_S()
            ->map(function ($projeto) {
                return [
                    'id' => $projeto['CodProj'],
                    'label' => $projeto['Nome']
                ];
            });

        return $projetos->toArray();
    }
}