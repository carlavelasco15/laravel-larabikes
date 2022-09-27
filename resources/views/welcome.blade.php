<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplicación de gestión de motos Larabikes">
    <title>{{config('app.name')}} - PORTADA</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body class="container p-3">
    <nav>
        <ul class="nav nav-pills my-3">
            <li class="nav-item mr-2"><a class="nav-link" href="{{url('/')}}"></a>Inici</li>
            <li class="nav-item mr-2"><a class="nav-link" href="{{route('bikes.index')}}">Garaje</a></li>
            <li class="nav-item mr-2"><a class="nav-link" href="{{route('bikes.create')}}">Nueva moto</a></li>
        </ul>
    </nav>

    <h1 class="my-2">Primer ejemplo con Laravel</h1>
    <main>
        <h2>Bienvenido a Larabikes</h2>
        <p>Implementación de un <b>CRUD</b> de motos.</p>
        <figure class="row mt-2 mb-2 col-10 offset-1">
            <img    class="d-block w-100"
                    src="{{asset('images/bikes/bike0.png')}}"
                    alt="Moto de Candela en Akira">
        </figure>
        @yield('main')
    </main>

    <footer class="page-footer font-smqll p-4 bg-light">
        <p>Aplicación creada por Robert Sallent como ejemplo en clase.
            Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>

</body>
</html>
