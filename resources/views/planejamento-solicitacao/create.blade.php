@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-5">Cadastrar solicitação</h5>
            <form class="form-horizontal" method="POST" action="{{ route('planejamento-solicitacoes.store') }}">
                @include('planejamento-solicitacao.partials._form')
                <div class="mt-5">
                    <a class="btn btn-secondary mr-2" href="{{route('planejamento-solicitacoes.index')}}">Voltar</a>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection