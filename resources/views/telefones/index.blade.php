@extends('layout')

@section('titulo') Telefones @endsection

@section('button')
<a href="{{ route('form_criar_telefone', ['id' => $territorioId]) }}" id="btnAdiciona" class="btn btn-dark mb-3">Adicionar Telefone</a>
@endsection

@section('corpo')

@isset ($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endisset

<div class="d-flex justify-content-center">
  <table class="tabelaTerritorios table table-striped">
    <thead>
      <tr>
        <th style="text-align:center" scope="col">Id</th>  
        <th style="text-align:center" scope="col">Unidade</th>
        <th style="text-align:center" scope="col">Numero Unidade</th>
        <th style="text-align:center" scope="col">Telefone</th>
        <th style="text-align:center" scope="col">Ativo</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
 
      <?php foreach($telefones as $telefone): ?>
          <tr>
              <td style="text-align:center">{{ $telefone->id_telefone }}</td>
              <td style="text-align:center">{{ $telefone->unidade }}</td>
              <td style="text-align:center">{{ $telefone->numero_unidade }}</td>
              <td style="text-align:center">{{ $telefone->telefone }}</td>
              <td style="text-align:center">{{ ($telefone->status ? 'Ativo' : 'Inativo') }}</td>
          </tr>
      <?php endforeach; ?>

    </tbody>
    </table>
  </div>

  <script>
    var input = document.getElementById("btnAdiciona");
    input.focus();
  </script>  

@endsection