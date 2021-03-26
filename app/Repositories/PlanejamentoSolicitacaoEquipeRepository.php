<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PlanejamentoSolicitacaoEquipe;
use App\Repositories\Repository;

class PlanejamentoSolicitacaoEquipeRepository extends Repository
{
    protected function getClass()
    {
        return PlanejamentoSolicitacaoEquipe::class;
    }

    public function PlanejamentoSolicitacaoEquipe_IU($data)
    {   
        try {
            $queryResult = DB::select("exec PlanejamentoSolicitacaoEquipe_IU ?, ?", [
                    \Arr::get($data, 'CodEq', null), 
                    \Arr::get($data, 'Nome', null),
                ]);
            
            return (int) $queryResult[0]->CodSol;
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoEquipe_S($CodEq = null)
    {   
        try {
            $equipes = new PlanejamentoSolicitacaoEquipe();

            $equipes = $equipes->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoEquipe_S ?", [
                    $CodEq
                ])
            );
            return $equipes;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoEquipe_P($data)
    {   
        try {
            $equipes = new PlanejamentoSolicitacaoEquipe();

            $equipes = $equipes->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoEquipe_P ?", [
                    \Arr::get($data, 'Pesquisa', null), 
                ])
            );
            return $equipes;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }
    
    public function PlanejamentoSolicitacaoEquipe_D($CodEq)
    {   
        try {
            DB::update("exec PlanejamentoSolicitacaoEquipe_D ?", [
                $CodEq
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
        $equipes = $this->PlanejamentoSolicitacaoEquipe_S()
            ->map(function ($equipe) {
                return [
                    'id' => $equipe['CodEq'],
                    'label' => $equipe['Nome']
                ];
            });

        return $equipes->toArray();
    }
}