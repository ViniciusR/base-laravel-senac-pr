<?php

namespace App\Http\Controllers;

use App\Repositories\PlanejamentoSolicitacaoClassificacaoRepository;
use App\Repositories\PlanejamentoSolicitacaoCoordenadorRepository;
use App\Repositories\PlanejamentoSolicitacaoProjetoRepository;
use App\Repositories\PlanejamentoSolicitacaoOrigemRepository;
use App\Repositories\PlanejamentoSolicitacaoRotuloRepository;
use App\Repositories\PlanejamentoSolicitacaoEquipeRepository;
use App\Repositories\PlanejamentoSolicitacaoRepository;
use App\Http\Requests\PlanejamentoSolicitacaoRequest;
use App\Http\Resources\PlanejamentoSolicitacao as PlanejamentoSolicitacaoResource;

class PlanejamentoSolicitacaoController extends Controller
{
    /**
     * Instantiate a new ListaDesejoController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Action de index. Listagem de solitações com paginação. 
     * Os dados são carregados pelo método getPagination().
     * Retorna a view index.blade.php
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = 'Pendente')
    {
        $status = $this->getStatusValido($status);
        //Consulta as origens via SP para exibi-las no filtro de busca (input select)
        $origens = (new PlanejamentoSolicitacaoOrigemRepository())
            ->toSelect();

        //Consulta os rotulos via SP para exibi-las no filtro de busca (input select)        
        $rotulos = (new PlanejamentoSolicitacaoRotuloRepository())
            ->toSelect();

        //Consulta as equipes via SP para exibi-las no filtro de busca (input select)
        $equipes = (new PlanejamentoSolicitacaoEquipeRepository())
            ->toSelect();

        //Retorna a view com as variáveis origens, rotulos, status, etc.
        return view('planejamento-solicitacao.index', compact('origens', 'rotulos', 'equipes', 'status'));
    }

    /**
     * Action de apenas exibir o formulário de cadastrar nova solicitação.
     * Também consulta e manda para tela os registros das tabelas de borda (foreign keys),
     * para exibi-los nos input select.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $origens = (new PlanejamentoSolicitacaoOrigemRepository())
            ->PlanejamentoSolicitacaoOrigem_S();

        $rotulos = (new PlanejamentoSolicitacaoRotuloRepository())
            ->PlanejamentoSolicitacaoRotulo_S();

        $projetos = (new PlanejamentoSolicitacaoProjetoRepository())
            ->PlanejamentoSolicitacaoProjeto_S();

        $classificacoes = (new PlanejamentoSolicitacaoClassificacaoRepository())
            ->PlanejamentoSolicitacaoClassificacao_S();

        $equipes = (new PlanejamentoSolicitacaoEquipeRepository())
            ->PlanejamentoSolicitacaoEquipe_S();

        $coordenadores = (new PlanejamentoSolicitacaoCoordenadorRepository())
            ->PlanejamentoSolicitacaoCoordenador_S();

        return view('planejamento-solicitacao.create', compact('origens', 'rotulos', 'projetos', 'classificacoes', 'equipes', 'coordenadores'));
    }

    /**
     * Action que salva um novo registro via requisição POST.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanejamentoSolicitacaoRequest $request, PlanejamentoSolicitacaoRepository $repositorio)
    {
        $data = $request->all();

        //A classe de repositório é responsável por executar as SPs.
        $response = $repositorio->planejamentoSolicitacao_IU($data, null);

        if ($response['status'] === 'success') {
                return redirect()
                        ->route('planejamento-solicitacoes.edit', $response['CodSol'])
                        ->with('success', 'Solicitação cadastrada com sucesso!');
        } elseif ($response['status'] === 'error') {
            return redirect()
                    ->back()
                    ->with('error', $response['message'])
                    ->withInput();
        }
    }

    /**
     * Action de apenas exibir o formulário de editar uma solicitação com base num CodSol passado por parâmetro na URL.
     * Também consulta e manda para tela os registros das tabelas de borda (foreign keys),
     * para exibi-los nos input select.
     *
     * @param  int  $CodSol
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanejamentoSolicitacaoRepository $repositorio, $CodSol)
    {
        //Carrega a solicitacao pelo CodSol passado na url
        $solicitacao = $repositorio->PlanejamentoSolicitacao_S($CodSol);
        
        $origens = (new PlanejamentoSolicitacaoOrigemRepository())
            ->PlanejamentoSolicitacaoOrigem_S();
        
        $rotulos = (new PlanejamentoSolicitacaoRotuloRepository())
            ->PlanejamentoSolicitacaoRotulo_S();

        $projetos = (new PlanejamentoSolicitacaoProjetoRepository())
            ->PlanejamentoSolicitacaoProjeto_S();

        $classificacoes = (new PlanejamentoSolicitacaoClassificacaoRepository())
            ->PlanejamentoSolicitacaoClassificacao_S();

        $equipes = (new PlanejamentoSolicitacaoEquipeRepository())
            ->PlanejamentoSolicitacaoEquipe_S();

        $coordenadores = (new PlanejamentoSolicitacaoCoordenadorRepository())
            ->PlanejamentoSolicitacaoCoordenador_S();

        return view('planejamento-solicitacao.edit', compact('solicitacao', 'origens', 'rotulos', 'projetos', 'classificacoes', 'equipes', 'coordenadores'));
    }

    /**
     * Action que atualiza um registro via requisição PUT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $CodSol
     * @return \Illuminate\Http\Response
     */
    public function update(PlanejamentoSolicitacaoRequest $request, PlanejamentoSolicitacaoRepository $repositorio, $CodSol)
    {
        $data = $request->all();
        
        //A classe de repositório é responsável por executar as SPs.
        $solicitacao = $repositorio->PlanejamentoSolicitacao_S($CodSol);
        $data['Prioridade'] = $solicitacao['Prioridade']; //Mantem a prioridade atual, pois ela não é atualizada na tela de edit.

        $response = $repositorio->planejamentoSolicitacao_IU($data, $CodSol);

        if ($response['status'] === 'success') {
                return redirect()
                        ->route('planejamento-solicitacoes.edit', $CodSol)
                        ->with('success', 'Solicitação atualizada com sucesso!');
        } elseif ($response['status'] === 'error') {
            return redirect()
                    ->back()
                    ->with('error', $response['message'])
                    ->withInput();
        }
    }

    /**
     * Action que deleta registro via requisição DELETE.
     *
     * @param  int  $CodSol
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanejamentoSolicitacaoRepository $repositorio, $CodSol)
    {
        //A classe de repositório é responsável por executar as SPs.
        $response = $repositorio->planejamentoSolicitacao_D($CodSol);

        if ($response['status'] === 'success') {
            return response()->json(['type' => 'success', 'message' => 'Solicitação excluída com sucesso!'], 201);
        } elseif ($response['status'] === 'error') {
            return response()->json(['type' => 'error', 'message' => $response['message']], 500);
        }
    }

    /**
     * Action que atualiza uma coluna de um registro.
     *
     * @param  int  $CodSol
     * @return \Illuminate\Http\Response
     */
    public function updateRow(PlanejamentoSolicitacaoRepository $repositorio, $CodSol, $coluna)
    {    
        $solicitacao = $repositorio->PlanejamentoSolicitacao_S($CodSol);

        $data = [
            $coluna => request($coluna),
            'Nome' => $solicitacao['Nome'],
        ];

        //A classe de repositório é responsável por executar as SPs.
        $response = $repositorio->planejamentoSolicitacao_IU($data, $CodSol);

        if ($response['status'] === 'success') {
            return response()->json(['type' => 'success', 'message' => 'Solicitação atualizada com sucesso!'], 201);
        } elseif ($response['status'] === 'error') {
            return response()->json(['type' => 'error', 'message' => $response['message']], 500);
        }
    }

    /**
     * Action que atualiza o status de um registro.
     *
     * @param  int  $CodSol
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(PlanejamentoSolicitacaoRepository $repositorio, $CodSol, $status)
    {    
        $solicitacao = $repositorio->PlanejamentoSolicitacao_S($CodSol);

        $data = [
            'Status' => $status,
            'Nome' => $solicitacao['Nome'],
        ];

        //A classe de repositório é responsável por executar as SPs.
        $response = $repositorio->planejamentoSolicitacao_IU($data, $CodSol);

        if ($response['status'] === 'success') {
            return response()->json(['type' => 'success', 'message' => 'Solicitação marcada como '.$status], 201);
        } elseif ($response['status'] === 'error') {
            return response()->json(['type' => 'error', 'message' => $response['message']], 500);
        }
    }

    /**
     * Método que constrói a paginação para exibi-la na action index.
     * Caso haja algum filtro de busca informado (pelo método request()),
     * o mesmo é enviado para a SP PlanejamentoSolicitacao_P.
     * 
     * Retorna a paginação em json através da classe App/Http/Resources/PlanejamentoSolicitacao
     */
    public function getPagination($pagination)
    {   
        $status = \Route::current()->parameter('status');
       
        $requestData = [
            'Pesquisa' => request('query'),
            'CodOr' => request('CodOr') ?? null,
            'CodRot' => request('CodRot') ?? null,
            'CodProj' => request('CodProj') ?? null,
            'CodClass' => request('CodClass') ?? null,
            'CodEq' => request('CodEq') ?? null,
            'Status' => $this->getStatusValido($status),
        ];
    
        //A classe de repositório é responsável por executar a SP de busca que retorna os registros pesquisados.
        $solicitacoes = (new PlanejamentoSolicitacaoRepository())->planejamentoSolicitacao_P($requestData);

        $pagination
            ->collection($solicitacoes)
            ->resource(PlanejamentoSolicitacaoResource::class);
    }

    private function getStatusValido($status)
    {
        $statusPossiveis = (new PlanejamentoSolicitacaoRepository())->getStatusOptions();

        if (in_array($status, $statusPossiveis)) {
            return $status;
        }

        return 'Pendente';
    }
}
