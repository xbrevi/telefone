@extends('layout')

@section('titulo')Território Telefone @endsection

@section('button')
<a href="{{ route('form_criar_territorio') }}" class="btn btn-dark mb-3">Adicionar Território</a>
<a href="{{ route('form_index_publicadores') }}" class="ml-2 btn btn-dark mb-3">Publicadores</a>
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
          <th scope="col">Número</th>  
          <th scope="col">Território</th>
          <th scope="col">Endereço</th>
          <th scope="col">Revisão</th>
          <th scope="col">Apartamentos</th>
          <th scope="col">Telefones</th>
          <th scope="col">Ocorrências</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($territorios as $territorio): ?>
            <tr>
                <td>
                  <a href="{{route('form_editar_territorio', [$territorio->id]) }}">
                    {{ $territorio->id }}
                  </a>
                </td>

                <td>{{ $territorio->condominio }}</td>
                <td>{{ $territorio->endereco }}</td>
                <td>{{ date('d-m-Y', strtotime($territorio->revisao)) }}</td>
                <td style="text-align:center">{{ $territorio->total_apartamentos }}</td>
                
                <td>
                  <form action="{{ route('form_listar_telefones', [$territorio->id]) }}">
                    @csrf
                    @method('GET')
                    <button class="btn btn-primary"><i class="fas fa-phone"></i></button>
                  </form>
                </td>

                {{-- <!-- BOTÃO OCORRENCIAS --> --}}
                <td>
                  <form action="{{ route('form_ocorrencias', [$territorio->id]) }}"> 
                    @csrf
                    @method('GET')
                    <button class="btn btn-secondary"><i class="fas fa-bullhorn"></i></button>
                  </form>
                </td>

            </tr>
        <?php endforeach; ?>

      </tbody>
      </table>

  </div>
@endsection