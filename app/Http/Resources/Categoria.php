<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Categoria extends JsonResource
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
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'codigo' => $this->codigo,
            'created_at' => format_date($this->created_at),
            'updated_at' => format_date($this->updated_at),
            'links' => [
                'edit' => $this->when(true, route('categorias.edit', $this->id)),
                'destroy' => $this->when(true, route('categorias.destroy', $this->id)),
            ],
        ];
    }
}