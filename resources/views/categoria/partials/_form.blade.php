@csrf

<div class="form-group">
    <label for="titulo">Nome</label> 
    <input type="text" name="titulo" class="{!! 'form-control'  . ($errors->has('titulo') ? 'has-danger' : '') !!}" id="titulo" placeholder="Título" value="{{old('titulo') ?? $categoria->titulo ?? ''}}">
    
    @if ($errors->has('titulo'))
        <div class="invalid-feedback">
        {{$errors->first('titulo') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="descricao">Descrição</label>
    <textarea name="descricao" class="{!! 'form-control'  . ($errors->has('descricao') ? 'has-danger' : '') !!}" id="descricao" placeholder="Descrição...">{{old('descricao') ?? $categoria->descricao ?? ''}}</textarea>
    
    @if ($errors->has('descricao'))
        <div class="invalid-feedback">
        {{$errors->first('descricao') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="codigo">Código</label>
    <input type="number" name="codigo" class="{!! 'form-control'  . ($errors->has('codigo') ? 'has-danger' : '') !!}" id="codigo" placeholder="Código" value="{{old('codigo') ?? $categoria->codigo ?? ''}}">
    
    @if ($errors->has('codigo'))
        <div class="invalid-feedback">
        {{$errors->first('codigo') }}
        </div>
    @endif
</div>
