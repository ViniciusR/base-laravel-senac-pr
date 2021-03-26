@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="{{route('categorias.index')}}">Categorias</a></li>
                        <li><a href="{{route('planejamento-solicitacoes.index')}}">Sistema de planejamento de solicitações</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
