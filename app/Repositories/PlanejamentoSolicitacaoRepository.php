<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PlanejamentoSolicitacao;
use App\Repositories\Repository;

class PlanejamentoSolicitacaoRepository extends Repository
{
    protected function getClass()
    {
        return PlanejamentoSolicitacao::class;
    }

    public function planejamentoSolicitacao_IU($data, $CodSol = null)
    {   
        try {
            $queryResult = DB::select("exec PlanejamentoSolicitacao_IU ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?", [
                    $CodSol, 
                    \Arr::get($data, 'Nome', null),
                    \Arr::get($data, 'CodOr', null),
                    \Arr::get($data, 'CodRot', null),
                    \Arr::get($data, 'CodProj', null),
                    \Arr::get($data, 'CodClass', null),
                    \Arr::get($data, 'CodEq', null),
                    \Arr::get($data, 'CodCoord', null),
                    \Arr::get($data, 'Prioridade', null),
                    \Arr::get($data, 'DtInicio', null),
                    \Arr::get($data, 'DtFim', null),
                    \Arr::get($data, 'Observacoes', null),
                    \Arr::get($data, 'Status', 'Pendente'),
                ]);
            
            return [
                'status' => 'success',
                'CodSol' => (int) $queryResult[0]->CodSol,
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            return [
                'status' => 'error',
                'message' => substr($e->errorInfo[2], 54), //$e->getMessage(),
            ];
        }

        return false;
    }

    public function planejamentoSolicitacao_S($CodSol = null)
    {   
        try {
            $solicitacao = new PlanejamentoSolicitacao();

            $solicitacao = $solicitacao->hydrate(
                 DB::select("exec PlanejamentoSolicitacao_S ?", [
                    $CodSol
                ])
            )->first();

            return $solicitacao;
            
        } catch (\Illuminate\Database\QueryException $e) {
            return [
                'status' => 'error',
                'message' => substr($e->errorInfo[2], 54), //$e->getMessage(),
            ];
        }

        return false;
    }

    public function planejamentoSolicitacao_P($data)
    {   
        try {
            $solicitacoes = new PlanejamentoSolicitacao();
           
            $solicitacoes = $solicitacoes->hydrate(
                 DB::select("exec PlanejamentoSolicitacao_P ?, ?, ?, ?, ?, ?, ?, ?", [
                    \Arr::get($data, 'Pesquisa', null), 
                    \Arr::get($data, 'CodOr', null),
                    \Arr::get($data, 'CodRot', null),
                    \Arr::get($data, 'CodProj', null),
                    \Arr::get($data, 'CodClass', null),
                    \Arr::get($data, 'CodEq', null),
                    \Arr::get($data, 'CodCoord', null),
                    \Arr::get($data, 'Status', null),
                ])
            );

            return $solicitacoes;
            
        } catch (\Illuminate\Database\QueryException $e) {
            return [
                'status' => 'error',
                'message' => substr($e->errorInfo[2], 54), //$e->getMessage(),
            ];
        }

        return false;
    }

    public function planejamentoSolicitacao_D($CodSol)
    {   
        try {
            DB::update("exec PlanejamentoSolicitacao_D ?", [
                $CodSol
            ]);

            return [
                'status' => 'success',
            ];   
        } catch (\Illuminate\Database\QueryException $e) {
            return [
                'status' => 'error',
                'message' => substr($e->errorInfo[2], 54), //$e->getMessage(),
            ];
        }

        return false;
    }

    public function getStatusOptions()
    {
        return [
            'Pendente',
            'Atendido',
            'Cancelado'
        ];
    }

    public function getStatusToVSelect()
    {
        $statusToSelect = [];

        foreach ($this->getStatusOptions() as $status) {
            $statusToSelect[] = [
                'id' => $status,
                'label' => $status
            ];
        }

        return $statusToSelect;
    }
}