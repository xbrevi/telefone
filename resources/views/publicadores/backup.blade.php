
@extends('layout')

@section('titulo')Publicadores @endsection

@section('corpo')

  @isset ($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
  @endisset

  <!-- FORM INCLUIR PUBLICADOR -->
  <div class="d-flex justify-content-center mb-5">
      <form class="form-inline" method="post" action="{{ route('form_store_publicadores') }}">
          <div class="form-group mx-sm-3 mb-2">
              <input type="text" class="form-control" style="width: 250px;" name="inputNome" id="inputNome" value="{{old('inputNome')}}">
          </div>
          @csrf
          <button type="submit" class="btn btn-primary mb-2">Incluir</button>
      </form> 
  </div>

  <div class="d-flex justify-content-center">
    <table class="tabelaTerritorios table table-striped">
      <thead>
        <tr>
          <th scope="col">Id</th>  
          <th scope="col">Nome</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($publicadores as $publicador): ?>
            <tr>
                <td id="nome-{{$publicador->id}}">
                    {{ $publicador->id }}
                </td>

                <td>{{ $publicador->nome }}</td>

                <div class="input-group w-50" hidden id="nome--{{ $publicador->id }}">
                  <input type="text" class="form-control" value="{{ $publicador->nome }}">
                  <div class="input-group-append">
                  <button class="btn btn-primary" onclick="editarNome({{ $publicador->id }})">
                  <i class="fas fa-check"></i>
                  </button>
                  @csrf
                  </div>
                </div>
                
                <td>

                  <!--
                  {{-- <form action="{{ route('form_listar_telefones', [$territorio->id]) }}"> --}}
                  <form action="">
                    @csrf
                    @method('GET')
                    <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                  </form>
                  -->

                  {{-- <!-- BOTÃO EDITAR - EXECUTA: toggleInput
                    ESCONDE O TEXTO COM O NOME E MOSTRA UMA CAIXA, COM O NOME COPIADO PARA ALTERAR E GRAVAR
                  --> --}}  
                  <span class="d-flex">
                      <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$publicador->id}})">
                        <i class="fas fa-edit"></i>
                      </button>
                  </span>

                </td>

            </tr>
        <?php endforeach; ?>

      </tbody>
      </table>
    </div>


<script>

  function toggleInput(publicadorId) {
    const nomePublicadorEl = document.getElementById(`nome-${publicadorId}`);
    const inputPublicadorEl = document.getElementById(`nome--{{ $publicador->id }}`);
    if (nomePublicadorEl.hasAttribute('hidden')) {
      nomePublicadorEl.removeAttribute('hidden');
      inputPublicadorEl.hidden = true;
    } else {
      inputPublicadorEl.removeAttribute('hidden');
      nomePublicadorEl.hidden = true;
    }
  }



</script>









@endsection