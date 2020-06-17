@extends('layout')

@section('cabecalho')
    Cadastro de Territórios
@endsection

@section('corpo')

<div class="container">
  <div class="row">
    <div class="col"> </div>
    <div class="col-8">

            <form method="post">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @csrf
            <div class="form-group">
                <label for="condominio">Condomínio</label>
                <input type="text" class="form-control" name="condominio" id="condominio" value="{{old('condominio')}}">

                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" name="endereco" id="endereco" value="{{old('endereco')}}">

                <label for="data_revisao">Data Revisão</label>
                <input type="date" class="form-control" name="data_revisao" id="data_revisao" value="{{old('data_revisao')}}">

            </div>
            <button class="btn btn-primary">Adicionar</button>
            </form>

    </div>
    <div class="col"> </div>
  </div>


@endsection
