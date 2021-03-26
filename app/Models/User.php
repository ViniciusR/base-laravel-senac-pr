<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Usuario';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Usuario';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Usuario', 
        'Nome', 
        'DataConeccao',
        'Ativo',
        'NovaSenha',
        'NivCod',
        'SPID',
        'UsuCallCenter',
        'EADCronogr',
        'AprCadTerceiros',
        'CadastroUsuarios',
        'ReabrirTurmas',
        'MaterialDidatico',
        'RG',
        'CPF',
        'Endereco',
        'EndeNro',
        'Complemento',
        'Bairro',
        'CidCod',
        'CEP',
        'DDD',
        'Telefone',
        'ContratoModelo',
        'CursoDisciplina',
        'Expurgo',
        'NovaVersao',
        'CadastrarTerceiros',
        'FornecerNrVetorH',
        'ExportarPagamentos',
        'ExportarProdDN',
        'CadastrarTEP',
        'CadastrarTRM',
        'SERASA',
        'TurmaPSGIniciada',
        'AlterarCalendarioContabilizado',
        'TutoriaEAD',
        'LiberaAdiantamentoTurmas',
        'FaturaFracionada',
        'AlterarResultado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Senha',
    ];


    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->Senha;
    }
}
