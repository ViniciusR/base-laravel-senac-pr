@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Editar categoria</div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('categorias.update', $categoria->id) }}">
                @method('PUT')
                @include('categoria.partials._form')
                <div class="mt-5">
                    <a class="btn btn-secondary mr-2" href="{{route('categorias.index')}}">Voltar</a>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection