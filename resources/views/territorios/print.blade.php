<?php  

    use App\Services\Formatador; 
    use App\Territorios;
    use Carbon\Carbon;

    $contadorTelefone = 0;

    function printHeader(Territorios $territorio) {
        $html = '';
        $html = '<div class="ml-3 mt-3">';
        
        $html = $html . '<div class="ml-3 mt-1">';
        $html = $html . '<span class="font-notable">TESTEMUNHO TELEFONE</span><br>';
        $html = $html . '<span class="font-anton-gray">Território: '; 
        $html = $html . '<span class="font-anton-bold">';
        $html = $html . $territorio->id . '</span> - ';        

        $html = $html . $territorio->condominio . 
            ' - Rev. ' . Carbon::parse($territorio->revisao)->format('d-m-y') . '<br>';

        $html = $html . 'Endereço: ' . $territorio->endereco . '</span></div>';        
        $html = $html . '<table class ="tablet">';
 
        return $html;
    }

?>

<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Território - {{ $territorio->condominio }} </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">        
        <link rel="stylesheet" href="{{URL::asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/css/welcome.css')}}">

    </head>

    <body>

        <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <?php foreach($telefones as $telefone): ?>
            {{-- IMPRIME HEADER NA PRIMEIRA PÁGINA E A CADA 5 TELEFONES --}}
            <?php
                if(!($contadorTelefone % 5)) 
                    echo printHeader($territorio);
            ?> 

            <?php $contadorTelefone++; ?>

                <!-- Apartamento / Telefone -->
                <tr class="trt-cab">
                    <td class="tdtelefone font-anton" colspan="3">
                        {{ $telefone->unidade }}
                        <span class="font-anton-bold">
                            {{ $telefone->numero_unidade }}
                        </span>
                        - Tel:
                        <span class="font-anton-bold">
                            {{ Formatador::formataTelefone($telefone->telefone) }}
                        </span>
                    </td>
                </tr>
  
                {{-- FORMULARIO MORADOR/ENDEREÇO/DATA --}}
                @include('territorios.morador')

                {{-- LINHAS --}}
                @include('territorios.linhas')
  
                <?php
                    // PAGEBREAK
                    if(!($contadorTelefone % 5)) echo '</table></div>';       
                ?>       

                <?php endforeach; ?>

            <?php if($contadorTelefone % 5) echo '</table></div>'; ?>    
    </body>
</html>