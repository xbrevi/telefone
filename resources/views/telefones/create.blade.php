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

    <form method="post" action="{{route('form_gravar_telefone', ['id' => $territorioId]) }}">
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
            <!-- NÚMERO -->
            <div class="form-group col-md-2">
                <label for="inputNumero">Número</label>
                <input type="text" autocomplete="off" class="form-control" name="inputNumero" id="inputNumero" value="{{old('inputNumero')}}">
            </div>
            @csrf
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </form>

</div>

<script>
    var input = document.getElementById("inputTel");
    input.focus();
</script>    

@endsection
