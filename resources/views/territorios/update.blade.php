@extends('layout')

@section('cabecalho')
    Editar Território Cabeçalho: {{ $territorio->condominio }} 
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
            <button class="btn btn-primary botaoPadrao">Atualizar</button>

        </form>

        <button id="botaoApagar" class="btn btn-danger botaoPadrao mt-2">Apagar</button>

    </div>
    <div class="col"> </div>
  </div>

<script>

    document.getElementById("condominio").value = '{{ $territorio->condominio }}';
    document.getElementById("endereco").value = '{{ $territorio->endereco }}';
    document.getElementById("data_revisao").value = '{{ $territorio->revisao }}';

    var botaoApagar = document.querySelector("#botaoApagar");
    botaoApagar.addEventListener("click", function(event) {
        //event.preventDefault();
        confirm('Tem certeza que deseja remover o Território {{ addslashes($territorio->condominio) }}? ');
        window.location.href = "/territorios/apagar/{{ $territorio->id }}";
    });

</script>

@endsection
