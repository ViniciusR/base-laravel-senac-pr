<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Scopes\Search as SearchScope;

/**
 * Class PlanejamentoSolicitacao.
 *
 * @package namespace App\Models;
 */
class PlanejamentoSolicitacao extends Model
{
    use SoftDeletes, SearchScope;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'PlanejamentoSolicitacao';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CodSol';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d';
    
     /**
     * The attributes that are used to search.
     *
     * @var array
     */
    protected $searchBy = [
        'Nome', 'DtInicio', 'DtFim', 'Observacoes', 'Status'
    ];

    protected $searchByRelationship = [

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nome', 
        'CodOr', 
        'CodRot', 
        'CodProj', 
        'CodClass', 
        'CodEq', 
        'CodCoord', 
        'Prioridade', 
        'DtInicio', 
        'DtFim', 
        'Observacoes',
        'Status'];
        
    protected $dates = ['deleted_at'];
}
