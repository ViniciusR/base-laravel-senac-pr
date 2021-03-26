<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Scopes\Search as SearchScope;

/**
 * Class PlanejamentoSolicitacaoRotulo.
 *
 * @package namespace App\Models;
 */
class PlanejamentoSolicitacaoRotulo extends Model
{
    use SoftDeletes, SearchScope;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'PlanejamentoSolicitacaoRotulo';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CodRot';
    
     /**
     * The attributes that are used to search.
     *
     * @var array
     */
    protected $searchBy = [
        'Nome',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nome'
    ];
}
