@csrf

<div class="form-group">
    <label for="Nome">Título <span class="text-danger">*</span></label> 
    <input type="text" required name="Nome" class="{!! 'form-control'  . ($errors->has('Nome') ? 'has-danger' : '') !!}" id="Nome" placeholder="Título da solitação" value="{{old('Nome') ?? $solicitacao->Nome ?? ''}}">
    
    @if ($errors->has('Nome'))
        <div class="invalid-feedback">
            {{$errors->first('Nome') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="CodOr">Origem</label> 
    
    <select name="CodOr" class="form-control">
        <option disabled selected value> -- Selecione a origem -- </option>
        @foreach ($origens as  $origem)
            <option value="{{ $origem->CodOr }}"
                @if (old('CodOr') ==  $origem->CodOr || (isset($solicitacao) && $solicitacao->CodOr == $origem->CodOr))
                    selected="selected"
                @endif
                >
                {{ $origem->Nome}}
            </option>
        @endforeach
    </select>

    
    @if ($errors->has('CodOr'))
        <div class="invalid-feedback">
            {{$errors->first('CodOr') }}
        </div>
    @endif
</div>

<div class="form-group">
        <label for="CodRot">Rótulo</label> 
        
        <select name="CodRot" class="form-control">
            <option disabled selected value> -- Selecione o rótulo -- </option>
            @foreach ($rotulos as  $rotulo)
                <option value="{{ $rotulo->CodRot }}"
                    @if (old('CodRot') ==  $rotulo->CodRot || (isset($solicitacao) && $solicitacao->CodRot == $rotulo->CodRot))
                        selected="selected"
                    @endif
                    >
                    {{ $rotulo->Nome}}
                </option>
            @endforeach
        </select>

        @if ($errors->has('CodRot'))
        <div class="invalid-feedback">
            {{$errors->first('CodRot') }}
        </div>
    @endif
</div>

<div class="form-group">
        <label for="CodProj">Projeto designado</label> 
        
        <select name="CodProj" class="form-control">
            <option disabled selected value> -- Selecione o projeto -- </option>
            @foreach ($projetos as  $projeto)
                <option value="{{ $projeto->CodProj }}"
                    @if (old('CodProj') ==  $projeto->CodProj || (isset($solicitacao) && $solicitacao->CodProj == $projeto->CodProj))
                        selected="selected"
                    @endif
                    >
                    {{ $projeto->Nome}}
                </option>
            @endforeach
        </select>

        @if ($errors->has('CodProj'))
        <div class="invalid-feedback">
            {{$errors->first('CodProj') }}
        </div>
    @endif
</div>

<div class="form-group">
        <label for="CodClass">Classificação</label> 
        
        <select name="CodClass" class="form-control">
            <option disabled selected value> -- Selecione a classificação -- </option>
            @foreach ($classificacoes as  $classificacao)
                <option value="{{ $classificacao->CodClass }}"
                    @if (old('CodClass') ==  $classificacao->CodClass || (isset($solicitacao) && $solicitacao->CodClass == $classificacao->CodClass))
                        selected="selected"
                    @endif
                    >
                    {{ $classificacao->Nome}}
                </option>
            @endforeach
        </select>

        @if ($errors->has('CodClass'))
        <div class="invalid-feedback">
            {{$errors->first('CodClass') }}
        </div>
    @endif
</div>

<div class="form-group">
        <label for="CodEq">Equipe</label> 
        
        <select name="CodEq" class="form-control">
            <option disabled selected value> -- Selecione a equipe -- </option>
            @foreach ($equipes as  $equipe)
                <option value="{{ $equipe->CodEq }}"
                    @if (old('CodEq') ==  $equipe->CodEq || (isset($solicitacao) && $solicitacao->CodEq == $equipe->CodEq))
                        selected="selected"
                    @endif
                    >
                    {{ $equipe->Nome}}
                </option>
            @endforeach
        </select>

        @if ($errors->has('CodEq'))
        <div class="invalid-feedback">
            {{$errors->first('CodEq') }}
        </div>
    @endif
</div>

<div class="form-group">
        <label for="CodCoord">Coordenador técnico</label> 
        
        <select name="CodCoord" class="form-control">
            <option disabled selected value> -- Selecione o coordenador -- </option>
            @foreach ($coordenadores as  $coordenador)
                <option value="{{ $coordenador->CodCoord }}"
                    @if (old('CodCoord') ==  $coordenador->CodCoord || (isset($solicitacao) && $solicitacao->CodCoord == $coordenador->CodCoord))
                        selected="selected"
                    @endif
                    >
                    {{ $coordenador->Nome}}
                </option>
            @endforeach
        </select>

        @if ($errors->has('CodCoord'))
        <div class="invalid-feedback">
            {{$errors->first('CodCoord') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="Observacoes">Observações</label>
    <textarea name="Observacoes" class="{!! 'form-control'  . ($errors->has('Observacoes') ? 'has-danger' : '') !!}" id="Observacoes" placeholder="Observações...">{{old('Observacoes') ?? $solicitacao->Observacoes ?? ''}}</textarea>
    
    @if ($errors->has('Observacoes'))
        <div class="invalid-feedback">
            {{$errors->first('Observacoes') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="DtInicio">Data de início</label> 
    <input type="text" name="DtInicio" class="{!! 'date datepicker form-control'  . ($errors->has('DtInicio') ? 'has-danger' : '') !!}" id="DtInicio" value="{{old('DtInicio') ?? isset($solicitacao->DtInicio) ? format_date($solicitacao->DtInicio) : ''}}">
    
    @if ($errors->has('DtInicio'))
        <div class="invalid-feedback">
            {{$errors->first('DtInicio') }}
        </div>
    @endif
</div>

<span class="text-danger">Campos com um * são obrigatórios</span>