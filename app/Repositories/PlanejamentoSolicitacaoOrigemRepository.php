<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PlanejamentoSolicitacaoOrigem;
use App\Repositories\Repository;

class PlanejamentoSolicitacaoOrigemRepository extends Repository
{
    protected function getClass()
    {
        return PlanejamentoSolicitacaoOrigem::class;
    }

    public function planejamentoSolicitacaoOrigem_IU($data)
    {   
        try {
            $queryResult = DB::select("exec PlanejamentoSolicitacaoOrigem_IU ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?", [
                    \Arr::get($data, 'CodOr', null), 
                    \Arr::get($data, 'Nome', null),
                ]);
            
            return (int) $queryResult[0]->CodSol;
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function planejamentoSolicitacaoOrigem_S($CodOr = null)
    {   
        try {
            $origens = new PlanejamentoSolicitacaoOrigem();

            $origens = $origens->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoOrigem_S ?", [
                    $CodOr
                ])
            );
            return $origens;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function planejamentoSolicitacaoOrigem_P($data)
    {   
        try {
            $origens = new PlanejamentoSolicitacaoOrigem();

            $origens = $origens->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoOrigem_P ?", [
                    \Arr::get($data, 'Pesquisa', null), 
                ])
            );
            return $origens;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }
    
    public function planejamentoSolicitacaoOrigem_D($CodOr)
    {   
        try {
            DB::update("exec PlanejamentoSolicitacaoOrigem_D ?", [
                $CodOr
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
        $origens = $this->PlanejamentoSolicitacaoOrigem_S()
            ->map(function ($origem) {
                return [
                    'id' => $origem['CodOr'],
                    'label' => $origem['Nome']
                ];
            });

        return $origens->toArray();
    }
}