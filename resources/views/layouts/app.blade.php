<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Resinet') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <style>
        /*footer {position: fixed;left: 0; bottom: 0; width: 100%;background-color:white;}*/
    </style>
</head>
@if(auth::check())
<body style="background: url({{asset('img')}}/{{$slide}}) no-repeat center;background-size:cover; height:100vh;">
@else
<body>
@endif
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="d-flex flex-wrap">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{url('/img/LogoM.png')}}" style="" alt="image intranet" title="intranet" />
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
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                                </li>
                            <li class="nav-item dropdown">
                                <a id="langDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __("Language")}} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
                                    <div class="d-flex flex-wrap">
                                    <a class="dropdown-item" href="{{route('setlang','en')}}"><img src="{{ asset('svg/001-uk.svg') }}"  style="width:40px;"></a>
                                    <a class="dropdown-item" href="{{route('setlang','fr')}}"><img src="{{ asset('svg/002-france.svg') }}" style="width:40px;"></a>
                                    <a class="dropdown-item" href="{{route('setlang','de')}}"><img src="{{ asset('svg/003-flag.svg') }}" style="width:40px;"></a>
                                    <a class="dropdown-item" href="{{route('setlang','it')}}"><img src="{{ asset('svg/004-italy.svg') }}" style="width:40px;"></a>
                                    <a class="dropdown-item" href="{{route('setlang','es')}}"><img src="{{ asset('svg/spain.svg') }}" style="width:40px;"></a>
                                    </div>
                                </div>
                            </li>

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                   <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->

                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item d-flex justify-content-space-between" href="{{ route('favoris') }}">{{ __('Favorite') }} <i class="fa fa-star sun-flower" aria-hidden="true" ></i></a>
                                    @if(auth::user()->group_id ==2)<a class="dropdown-item" href="{{ route('admin') }}">{{ __('Administrator') }} <i class="fas fa-user-secret"></i></a>@endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    @if(auth::check())
                    <div>
                    <form id='search' onsubmit="return false" >
                        @csrf
                        <div class="input-group">
                            <input type="search" class="form-control" name="q" id="q" >
                            <div class="input-group-append">
                                <span id='loupe' class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </form>
                    </div>
                    @endif
                </div>
            </div>

        </nav>
        @if(auth::check())
            <main class=" py-4" >
            <blockquote class="text-center banner p-1 anim-promo bg-amethyst"><cite class=""> <h1 class=" font20 cloud anim-carte ">{{ __($citation) }} </h1></cite></blockquote>
        @endif
        @if(!auth::check())
            @yield('content')
        @endif
        @if(auth::check())
            @yield('admin')
            @yield('register')
            @yield('breadcrumb')
            @yield('box')

        @endif
        </main>
		 @include('layouts.footer')
    </div>
    <script>
        function init(){
            let search = document.getElementById('q');
            let response='';
            $("#q").change(function(e){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
                    }
                });

                $.ajax({
                url: '{{ route('ajax') }}',
                    type: 'POST',
                    data: {
                        'search': search.value
                    },

                dataType: 'JSON',
                    success: function (data) {
                        console.log(data)

                        data.map((box)=>{
                            console.log(box.title)
                            response+= `<div class=" m-2 " style="min-width: 14rem; max-width: 20rem;">`;
                                    if(box.type =='Web'){
                                    response+= `<div style="min-width: 14rem;background:${box.color};"><i class='p-1 fas fa-desktop text-center cloud' style='font-size:22px;'></i></div>`
                                    }else{
                                    response+= `<div style="min-width: 14rem;background:${box.color};"><i class='p-1 fas fa-tools text-center cloud' style='font-size:22px;'></i></div>`
                                    }
                                    response+= `
                                    <div class="card-body bg-cloud filter-effect filter-effect-show ">
                                        <h4 class="card-title text-center break-word launcher-bigger"><a href="${box.href}" class=" no-deco">${box.title}</a></h4>
                                        <div class="d-flex justify-content-between">
                                            <p class="card-text">${box.category}</p>
                                                <div>

                                                </div>
                                        </div>
                                    </div>
                            </div>`;
                        });
                        $('#search-box').html(response);
                        response='';


                    },
                    error: function (e) {
                        console.log(e.responseText);
                    }
                });
            });
        }
        window.addEventListener('load',init);
    </script>
</body>
</html>
