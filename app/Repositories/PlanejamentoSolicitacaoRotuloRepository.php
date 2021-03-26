<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PlanejamentoSolicitacaoRotulo;
use App\Repositories\Repository;

class PlanejamentoSolicitacaoRotuloRepository extends Repository
{
    protected function getClass()
    {
        return PlanejamentoSolicitacaoRotulo::class;
    }

    public function PlanejamentoSolicitacaoRotulo_IU($data)
    {   
        try {
            $queryResult = DB::select("exec PlanejamentoSolicitacaoRotulo_IU ?, ?", [
                    \Arr::get($data, 'CodRot', null), 
                    \Arr::get($data, 'Nome', null),
                ]);
            
            return (int) $queryResult[0]->CodSol;
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoRotulo_S($CodRot = null)
    {   
        try {
            $rotulos = new PlanejamentoSolicitacaoRotulo();

            $rotulos = $rotulos->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoRotulo_S ?", [
                    $CodRot
                ])
            );
            return $rotulos;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoRotulo_P($data)
    {   
        try {
            $rotulos = new PlanejamentoSolicitacaoRotulo();

            $rotulos = $rotulos->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoRotulo_P ?", [
                    \Arr::get($data, 'Pesquisa', null), 
                ])
            );
            return $rotulos;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }
    
    public function PlanejamentoSolicitacaoRotulo_D($CodRot)
    {   
        try {
            DB::update("exec PlanejamentoSolicitacaoRotulo_D ?", [
                $CodRot
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
        $rotulos = $this->PlanejamentoSolicitacaoRotulo_S()
            ->map(function ($rotulo) {
                return [
                    'id' => $rotulo['CodRot'],
                    'label' => $rotulo['Nome']
                ];
            });

        return $rotulos->toArray();
    }
}