@extends('layouts.app')

@section('breadcrumb')
    <breadcrumb header="Planejamento de solicitações">
        <breadcrumb-item href="{{ route('home') }}">
           Início
        </breadcrumb-item>

        <breadcrumb-item active>
            Planejamento de solicitações
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="row mt-3">
    <div class="col-md-12">

        <data-list data-source="{{ route('pagination.planejamento-solicitacoes', $status) }}"
                   delete-message="Tem certeza que deseja apagar este registro ?"
                   url-create="{{ route('planejamento-solicitacoes.create') }}"
                   url-update-row="{{ route('ajax.planejamento-solicitacoes.update-row', [null, null]) }}"
                   label-create="Nova solicitação"
                   />
   </div>
</div>
@endsection

@section('custom-template')
    
    <template id="data-list" slot-scope="modelScope">
        <div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Busca</h5>

                    <div class="row my-2">

                        <div class="col-md-4">
                            <input type="text" v-model="query" class="form-control" placeholder="Buscar..." >
                        </div>
        
                        <div class="col-md-4">
                            <filter-select 
                                url-key="CodOr"
                                :options="{{  json_encode($origens) }}"
                                placeholder="Origem"
                            >
                            </filter-select>   
                        </div>

                        <div class="col-md-4">
                            <filter-select 
                                url-key="CodRot"
                                :options="{{  json_encode($rotulos) }}"
                                placeholder="Rótulo"
                            >
                            </filter-select>   
                        </div>
                        
                    </div>

                    <div class="row my-2">
                        <div class="col-md-4">
                            <filter-select 
                                url-key="CodEq"
                                :options="{{  json_encode($equipes) }}"
                                placeholder="Equipe"
                            >
                            </filter-select>   
                        </div>
                    </div>

                </div>
            </div>

            <div class="card mt-4">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="{!! 'nav-link' . (($status == 'Pendente' || !$status) ? ' active' : '') !!}" id="tab-pendentes" href="{{ route('planejamento-solicitacoes.index', 'Pendente') }}" role="tab" aria-controls="pendentes" aria-selected="true">Pendentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="{!! 'nav-link' . ($status == 'Atendido' ? ' active' : '') !!}" id="tab-atendidos" href="{{ route('planejamento-solicitacoes.index', 'Atendido') }}" role="tab" aria-controls="atendidos" aria-selected="false">Atendidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="{!! 'nav-link' . ($status == 'Cancelado' ? ' active' : '')  !!}" id="tab-cancelados" href="{{ route('planejamento-solicitacoes.index', 'Cancelado') }}" role="tab" aria-controls="cancelados" aria-selected="true">Cancelados</a>
                    </li>
                </ul>

                <div class="tab-content" id="conteudoAbas">

                     <div class="tab-pane fade show active" id="pendentes" role="tabpanel" aria-labelledby="tab-pendentes">
                        <div class="card-body">
                            <div class="col-md-12 text-right mb-3">
                                <a v-if="urlCreate" :href="urlCreate">
                                    <button class="btn btn-success"><i class="fa fa-plus mr-2"></i> @{{labelCreate}}</button>
                                </a>
                            </div>
                            <loading></loading>
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        @if ($status === 'Pendente' )
                                            @include('planejamento-solicitacao.partials.pendentes._head')
                                        @elseif ($status === 'Atendido' )
                                            @include('planejamento-solicitacao.partials.atendidos._head')
                                        @elseif ($status === 'Cancelado' )
                                            @include('planejamento-solicitacao.partials.cancelados._head')
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in items" :key="index">
                                        @if ($status === 'Pendente' )
                                            @include('planejamento-solicitacao.partials.pendentes._body')
                                        @elseif ($status === 'Atendido' )
                                            @include('planejamento-solicitacao.partials.atendidos._body')
                                        @elseif ($status === 'Cancelado' )
                                            @include('planejamento-solicitacao.partials.cancelados._body')
                                        @endif
                                                        
                                        <td class="text-right" style="width: 15%">
                                            @if ($status === 'Pendente' )
                                                @include('planejamento-solicitacao.partials.pendentes._buttons_actions')
                                            @elseif ($status === 'Atendido' )
                                                @include('planejamento-solicitacao.partials.atendidos._buttons_actions')
                                            @elseif ($status === 'Cancelado' )
                                                @include('planejamento-solicitacao.partials.cancelados._buttons_actions')
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @include('shared.partials._pagination')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </template>
@endsection
