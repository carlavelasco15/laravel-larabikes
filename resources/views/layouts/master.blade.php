<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplicación de gestión de motos Larabikes">
    <title>{{config('app.name')}} - @yield('titulo')</title>

    <!-- CSS para Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body class="container p-3">
    @env(['local', 'test'])
        <div class="alert alert-warning">
            <b>Atención:</b> estas probando la aplicación en modo local o test.
        </div>
    @endenv

    @section('navegacion')
    <nav>
        <ul class="nav nav-pills my-3">
            <li class="nav-item mr-2">
                <a class="nav-link {{ $pagina == 'portada' ? 'active': '' }}" href="{{url('/')}}">Inici</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link {{ $pagina == 'listamotos' ? 'active': '' }}" href="{{route('bikes.index')}}">Garaje</a>
            </li>
            <!-- @auth -->
            <li class="nav-item mr-2">
                <a class="nav-link {{ $pagina == 'nuevamoto' ? 'active': '' }}" href="{{route('bikes.create')}}">Nueva moto</a>
            </li>
            <!-- @endauth -->
        </ul>
    </nav>
    @show

    <h1 class="my-2">Primer ejemplo con Laravel</h1>

    <main>
        <h2>@yield('titulo')</h2>

        @includeWhen(Session::has('success'), 'layouts.success')
        @includeWhen($errors->any(), 'layouts.error')
        
        @yield('contenido')


        <div class="btn-group" role="group" aria-label="Links">
            @section('enlaces')
                <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
            @show
        </div>
    </main>

    <!-- FOOTER -->
    @section('pie')
    <footer class="page-footer font-small p-4 bg-light">
        <p>Aplicación creada por Robert Sallent como ejemplo en clase.
            Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>
    @show

</body>
</html>