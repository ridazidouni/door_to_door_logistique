<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="img/logo.png">

    
    <!-- Scripts -->
    <script src="{{ asset('sources/jquery.min.js') }}"></script>
    <script src="{{ asset('sources/tether.min.js') }}"></script>
    <script src="{{ asset('sources/bootstrap.js') }}"></script>
    
    <script src="{{ asset('js/app.js') }}" ></script>
    
    
    <script src="{{ asset('sources/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('sources/moment.js') }}"></script>
    
    
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

    <script src="{{ asset('sources/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('sources/dataTables.select.min.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.15/integration/font-awesome/dataTables.fontAwesome.css">
    
    <!-- tempusdominus -->
    
    <link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}" />
    <script type="text/javascript" src="{{ asset('sources/tempusdominus-bootstrap-4.min.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    
    

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-color: #f8fafc;">
            <div class="container-fluid">
                <a style="font-weight: bolder;color: #e3342f;" class="navbar-brand" href="{{ url('/index') }}">
                    SJL Tracking
                </a>
                
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    {{ __('Se connecter') }}
                                </a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            @if(Auth::user()->is_admin || Auth::user()->onlyread)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('statistics') }}">{{ __('Statistics') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listuser') }}">{{ __('Liste des Utilisateurs') }}</a>
                            </li>
                            @endif
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user"></i> 
                                    {{ Auth::user()->name }} 
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('newpassword') }}">
                                       <i class="fa fa-key"></i>
                                        {{ __('réinitialiser votre mot de passe') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>
                                        {{ __('Déconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pb-4">
            @yield('content')
        </main>
    </div>

    
    
    


    
</body>
</html>
