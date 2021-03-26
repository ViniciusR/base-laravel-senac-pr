<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PlanejamentoSolicitacaoCoordenador;
use App\Repositories\Repository;

class PlanejamentoSolicitacaoCoordenadorRepository extends Repository
{
    protected function getClass()
    {
        return PlanejamentoSolicitacaoCoordenador::class;
    }

    public function PlanejamentoSolicitacaoCoordenador_IU($data)
    {   
        try {
            $queryResult = DB::select("exec PlanejamentoSolicitacaoCoordenador_IU ?, ?", [
                    \Arr::get($data, 'CodCoord', null), 
                    \Arr::get($data, 'Nome', null),
                ]);
            
            return (int) $queryResult[0]->CodSol;
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoCoordenador_S($CodCoord = null)
    {   
        try {
            $coordenadores = new PlanejamentoSolicitacaoCoordenador();

            $coordenadores = $coordenadores->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoCoordenador_S ?", [
                    $CodCoord
                ])
            );
            return $coordenadores;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }

    public function PlanejamentoSolicitacaoCoordenador_P($data)
    {   
        try {
            $coordenadores = new PlanejamentoSolicitacaoCoordenador();

            $coordenadores = $coordenadores->hydrate(
                 DB::select("exec PlanejamentoSolicitacaoCoordenador_P ?", [
                    \Arr::get($data, 'Pesquisa', null), 
                ])
            );
            return $coordenadores;
            
        } catch (\Illuminate\Database\QueryException $e) {
            throw $e->getMessage();
            return false;
        }

        return false;
    }
    
    public function PlanejamentoSolicitacaoCoordenador_D($CodCoord)
    {   
        try {
            DB::update("exec PlanejamentoSolicitacaoCoordenador_D ?", [
                $CodCoord
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
        $coordenadores = $this->PlanejamentoSolicitacaoCoordenador_S()
            ->map(function ($coordenador) {
                return [
                    'id' => $coordenador['CodCoord'],
                    'label' => $coordenador['Nome']
                ];
            });

        return $coordenadores->toArray();
    }
}