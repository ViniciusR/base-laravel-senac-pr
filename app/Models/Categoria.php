<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Scopes\Search as SearchScope;

/**
 * Class Categoria.
 *
 * @package namespace App\Models;
 */
class Categoria extends Model
{
    use SoftDeletes, SearchScope;

    protected $connection = 'pgsql';
    
     /**
     * The attributes that are used to search.
     *
     * @var array
     */
    protected $searchBy = [
        'titulo', 'descricao', 'codigo',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['titulo', 'descricao', 'codigo'];
	protected $dates = ['deleted_at'];
}
