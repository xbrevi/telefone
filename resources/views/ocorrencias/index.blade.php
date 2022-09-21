@extends('layout')

@section('titulo') Cadastro de Ocorrências @endsection

@section('corpo')

@isset ($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endisset

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="d-flex justify-content-center">

  <form action="/ocorrencias/gravar" method="post">

    {{-- <!-- TERRITORIO --> --}}
    <div hidden class="form-group row">
        <input type="text" hidden value="{{ $territorio_id }}" name="territorio_id">
    </div>


    {{-- <!-- SELEÇÃO DO PUBLICADOR --> --}}
    <div class="form-group row">
        <select name="publicador">
            <?php foreach($publicadores as $publicador): ?>
                <option value="{{ $publicador->id }}"> {{ $publicador->nome }}  </option>
            <?php endforeach; ?>   
        </select>
    </div>

    {{-- <!-- SELEÇÃO DA DATA --> --}}
    <div class="form-group row">    
        <input type="date" name="data">
    </div>

    {{-- <!-- TABELA RELAÇÃO DE TELEFONES --> --}}
    <table class="tabelaTerritorios table table-striped">

        {{-- <!-- CABEÇALHO DA RELAÇÃO DE TELEFONES --> --}}
        <thead>
        <tr>
            <th style="text-align:center" scope="col">Id</th>  
            <th style="text-align:center" scope="col">Unidade</th>
            <th style="text-align:center" scope="col">Numero Unidade</th>
            <th style="text-align:center" scope="col">Telefone</th>
            <th style="text-align:center" scope="col">Observação</th>
            <th style="text-align:center" scope="col">Ocorrência</th>
            <th style="text-align:center" scope="col">Inativar</th>
        </tr>
        </thead>

        <tbody>

        <?php $contador = 0; ?>
    
        <?php foreach($telefones as $telefone): ?>
            <tr>
                {{-- <!-- TELEFONE ID, UNIDADE, NUMERO, TELEFONE --> --}}
                <td style="text-align:center">{{ $telefone->id }}</td>
                <td style="text-align:center">{{ $telefone->unidade }}</td>
                <td style="text-align:center">{{ $telefone->numero_unidade }}</td>
                <td style="text-align:center">{{ $telefone->telefone }}</td>

                {{-- <!-- OBSERVAÇÃO --> --}}
                <td style="text-align:center">
                    <input class="form-control" type="text" name="observacoes[]">
                </td>
                
                {{-- <!-- OCORRENCIA --> --}}
                <td style="text-align:center">
                    <input type="checkbox" class="form-check-input" name="ocorrencias[]" 
                        {{ old('checked') }}
                        value="{{ $telefone->id }}"
                    />
                </td>

                {{-- <!-- INATIVAR --> --}}
                <td style="text-align:center">
                    <input type="checkbox" class="form-check-input" 
                        value="{{ $telefone->id }}" name="inativos[]"/>
                </td>

                {{-- <!-- CAMPO HIDDEN PARA ANOTAR POSIÇÃO DE CADA ID DE TELEFONE VS OBSERVAÇÃO --> --}}
                <td style="text-align:center">
                    <input class="form-control" type="text" hidden  
                        value="{{ $telefone->id }}" name="obs_mapa[]" />            
                </td>

            </tr>

            <?php $contador++; ?>

        <?php endforeach; ?>

        </tbody>
        </table>

        <div class="form-group row">
            @csrf
            <button class="btn btn-primary mt-2 mb-2">Salvar</button>
        </div>    

    </form>        

  </div>

  <br>
  <br>    

  <script>
    var input = document.getElementById("btnAdiciona");
    input.focus();
  </script>  

@endsection