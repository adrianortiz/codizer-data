<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">

    <title>@yield('title', 'App')</title>
</head>
<body>



<nav class="navbar navbar-fixed-top admin-menu-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="{{ asset('/images/logo.svg') }}"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                @if (!Auth::guest())
                    <li><a href="{{ route('panel') }}">Panel</a></li>
                @endif

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="admin-menu-left">

</div>
<div class="admin-menu-left-list">
    <ul>
        <li><p>Administración</p></li>
        <li><a href="#"><div>Cuenta</div></a></li>
        <li><a href="/admin/colecciones"><div>Colecciones</div></a></li>
        <li><a href="#"><div>Estadísticas</div></a></li>
        <li><p>Datos</p></li>
        <li><a href="#"><div>Acerca de...</div></a></li>
    </ul>
</div>
<div class="admin-contanier-global">



@yield('content')


</div>

<div class="notificacion-text-fondo" style="display: none;">
    <div class="notificacion-text">
        <div>
            <p>Mensaje</p>
            <p>Esta acción no se puede deshacer.<br>¿Esta seguro?</p>
        </div>
        <div>
            <button id="si">Si</button>
            <button id="no">No</button>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

@yield('scripts')
</body>
</html>