@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-5">Solicitação #{{$solicitacao->CodSol}} - Editar</h5>
            <form class="form-horizontal" method="POST" action="{{ route('planejamento-solicitacoes.update', $solicitacao->CodSol) }}">
                @method('PUT')
                @include('planejamento-solicitacao.partials._form')
                <div class="mt-5">
                    <a class="btn btn-secondary mr-2" href="{{route('planejamento-solicitacoes.index')}}">Voltar</a>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection