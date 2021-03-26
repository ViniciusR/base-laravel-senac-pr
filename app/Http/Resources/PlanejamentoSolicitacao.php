<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanejamentoSolicitacao extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'CodSol' => $this->CodSol,
            'id' => '#'.$this->CodSol,
            'Nome' => $this->Nome,
            'OrigemNome' => $this->OrigemNome ?? '-',
            'RotuloNome' => $this->RotuloNome ?? '-',
            'ProjetoNome' => $this->ProjetoNome ?? '-',
            'ClassificacaoNome' => $this->ClassificacaoNome ?? '-',
            'EquipeNome' => $this->EquipeNome ?? '-',
            'CoordenadorNome' => $this->CoordenadorNome ?? '-',
            'Prioridade' => $this->Prioridade,
            'DtInicio' => format_date($this->DtInicio, 'd/m/Y') ?? '-',
            'DtFim' => format_date($this->DtFim, 'd/m/Y') ?? '-',
            'Observacoes' => $this->Observacoes ?? '-',
            'Status' => $this->Status ?? '-',
            'links' => [
                'edit' => $this->when(true, route('planejamento-solicitacoes.edit', $this->CodSol)),
                'destroy' => $this->when(true, route('planejamento-solicitacoes.destroy', $this->CodSol)),
                'updateStatusPendente' => $this->when(
                        $this->Status == 'Atendido' ||  $this->Status == 'Cancelado', 
                        route('ajax.planejamento-solicitacoes.update-status', [$this->CodSol, 'Pendente'])
                    ),
                'updateStatusAtendido' => $this->when(   
                    $this->Status == 'Pendente' ||  $this->Status == 'Cancelado', 
                        route('ajax.planejamento-solicitacoes.update-status', [$this->CodSol, 'Atendido'])
                    ),
                'updateStatusCancelado' => $this->when(
                        $this->Status == 'Pendente', 
                        route('ajax.planejamento-solicitacoes.update-status', [$this->CodSol, 'Cancelado'])
                    ),
            ],
        ];
    }
}