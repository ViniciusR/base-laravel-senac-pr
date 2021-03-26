@extends('layouts.app')

@section('breadcrumb')
    <breadcrumb header="Categorias">
        <breadcrumb-item href="{{ route('home') }}">
           Início
        </breadcrumb-item>

        <breadcrumb-item active>
            Categorias
        </breadcrumb-item>
    </breadcrumb>
@endsection

@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <data-list data-source="{{ route('pagination.categorias') }}"
                   delete-message="Tem certeza que deseja apagar este registro ?"
                   url-create="{{ route('categorias.create') }}"
                   label-create="Nova categoria"
                   />
   </div>
</div>
@endsection

@section('custom-template')
    <template id="data-list" slot-scope="modelScope">
        <div>
            <div class="row my-2">
                <div class="col-md-4">
                    <input type="text" v-model="query" class="form-control" placeholder="Buscar..." >
                </div>
                
                <div class="col-md-4">
                    <filter-text 
                        url-key="busca_codigo"
                        placeholder="Buscar por código...">
                    </filter-text>   
                </div>
                
                <div class="col-md-4 text-right">
                    <a v-if="urlCreate" :href="urlCreate">
                        <button class="btn btn-success"><i class="fa fa-plus mr-2"></i> @{{labelCreate}}</button>
                    </a>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        @include('categoria.partials._head')
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items" :key="index">
                        @include('categoria.partials._body')
                        <td class="text-right">@include('shared.partials._buttons_actions')</td>
                    </tr>
                </tbody>
            </table>
            @include('shared.partials._pagination')
        </div>
    </template>
@endsection
