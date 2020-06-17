
@extends('layout')

@section('titulo')Território Telefone @endsection

@section('button')
<a href="{{ route('form_criar_territorio') }}" class="btn btn-dark mb-3">Adicionar Território</a>
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
        <th scope="col">Movto</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($territorios as $territorio): ?>
          <tr>
              <td>
                <a href="/territorio/{{ $territorio->id }}/edit">
                  {{ $territorio->id }}
                </a>
              </td>

              <td>{{ $territorio->condominio }}</td>
              <td>{{ $territorio->endereco }}</td>
              <td>{{ date('d-m-Y', strtotime($territorio->revisao)) }}</td>
              <td style="text-align:center">{{ $territorio->total_apartamentos }}</td>

              <td>
                <form action="{{route('form_listar_telefones', ['id' => $territorio->id]) }}">
                  @csrf
                  @method('GET')
                  <button class="btn btn-primary"><i class="fas fa-phone"></i></button>
                </form>
              </td>

              <td>
                <form method="post" action="/territorios/editar/{{$territorio->id}}" onsubmit=" return confirm('Tem certeza que deseja editar {{ addslashes( $territorio->condominio )}}?')">
                  @csrf
                  @method('GET')
                  <button class="btn btn-secondary"><i class="far fa-calendar-alt"></i></button>
                </form>
              </td>

              {{--
              <td>
                <form method="delete" action="/territorios/apagar/{{ $territorio->id }}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $territorio->condominio )}}?')">
                  @csrf
                  <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                </form>
              </td>
              --}}

           </tr>
      <?php endforeach; ?>
    </tbody>
    </table>
  </div>
@endsection