<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('titulo')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="{{URL::asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/css/welcome.css')}}">
    </head>

    <body>

        {{-- <img src="/images/banner.jpg" class="img-fluid" alt="Responsive image"> --}}
        <img src="{{URL::asset('/images/banner.jpg')}}" class="img-fluid" alt="Responsive image">

            <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
                @auth
                    <a class="navbar-brand" href="{{ url('/home') }}">Home</a>
                    <a href="{{ url('/sair') }}">Sair</a>
                @endauth
            </nav>

        <div class="flex-center position-ref">
        
                {{-- 
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
                --}}

            <div class="content">
                <div class="title meuTitulo m-b-md">
                    {{ $topico }}
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
        @yield('button')
        </div>
        @yield('corpo')

        <div class="d-flex flex-row-reverse mr-3">
            Território Telefones 2.0 - 06/01/2021
        </div>

    </body>
</html>
