<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0px;
            padding: 0px;
            background: rgb(242, 242, 242);
            padding-bottom: 120px;
        }

        .topbar {
            height: 50px;
            background-color: #222;
        }

        .status {
            min-height: 80px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        .author {
            font-size: 14px;
        }

        .author,
        .content {
            color: #555;
            line-height: 1.5em;
        }

        .date {
            padding-left: 10px;
            color: #aaa;
        }

        .header {
            background-color: #222;
            min-height: 200px;
        }

        .site-title {
            padding-top: 50px;
            text-align: center;
            font-size: 40px;
            color: #fff;
        }

        .actions, .actions a {
            color: #fff;
            text-align: center;
        }
        .logutLinkShow{
            display: block;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                CMS
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logoutLink" id="userMenu">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Profile
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="header mb-3">
        <div class="container h-100">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-title">{{ $name ?? 'Home' }}</div>
                    <div class="actions">
                        @yield('actions')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    @yield('form');
    @yield('status');
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('click', function(e){
            if(e.target.closest('#navbarDropdown')){
                document.getElementById('userMenu').classList.toggle('logutLinkShow');
            }else {
                document.getElementById('userMenu')?.classList.remove('logutLinkShow');
            }
        })

    </script>
</body>

</html>