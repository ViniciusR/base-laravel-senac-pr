<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Categoria;

class PlanejamentoSolicitacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        //Create Policies if there's more than one type of users. Currently there's admin only.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nome' => 'required|string|max:255',
            'Observacoes' => 'nullable|string|max:255',
            'DtInicio' => 'nullable|date_format:"d/m/Y"',
            'DtFim' => 'nullable|date_format:"d/m/Y"|after_or_equal:DtInicio',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'Nome.required' => 'O nome da solicitação é obrigatório',
            'DtFim.after_or_equal'  => 'A data de término não pode ser inferior à data de início',
            'Observacoes.max'  => 'Insira no máximo 255 caracteres.',
        ];
    }
}
