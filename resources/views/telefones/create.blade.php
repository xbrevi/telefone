@extends('layout')

@section('topico')
    Cadastro de Telefones
@endsection

@section('corpo')

<div class="container">

<!--
    @isset ($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
    @endisset
-->

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{route('form_gravar_telefone', ['territorioId' => $territorioId]) }}">
        <div class="form-row">
            <!-- TELEFONE -->
            <div class="form-group col-md-5">
                <label for="inputTel">Telefone</label>
                <input type="text" autocomplete="off" class="form-control" name="inputTel" id="inputTel" value="{{old('inputTel')}}">
            </div>
            <!-- UNIDADE -->
            <div class="form-group col-md-5">
                <label for="selectUnidade">Unidade</label>
                <select id="selectUnidade" class="form-control" name="selectUnidade" value="{{old('selectUnidade')}}">
                <option value="Apartamento">Apartamento</option>
                <option value="Casa">Casa</option>
                <option value="Portaria">Portaria</option>
                <option value="Outro">Outro</option>
                </select>
            </div>
        </div>
        <div class="form-row">    
            <!-- NÚMERO -->
            <div class="form-group col-md-5">
                <label for="inputNumero">Número | Endereço (Território Especial)</label>
                <input type="text" autocomplete="off" class="form-control" name="inputNumero" id="inputNumero" value="{{old('inputNumero')}}">
            </div>
        </div>    

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Situação</legend>
                <div class="col-sm-6">
                <div class="form-check">
                <input class="form-check-input" 
                       type="radio" 
                       name="Radio" 
                       id="gridRadios1" 
                       value="1" checked>
                <label class="form-check-label" for="gridRadios1">
                    Ativo
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" 
                       type="radio" 
                       name="Radio" 
                       id="gridRadios2" 
                       value="0">
                <label class="form-check-label" for="gridRadios2">
                    Inativo
                </label>
            </div>
        </fieldset>

        @csrf
        <button type="submit" class="btn btn-primary">Adicionar</button>
    
    </form>

</div>

<script>
    var input = document.getElementById("inputTel");
    input.focus();
</script>    

@endsection
