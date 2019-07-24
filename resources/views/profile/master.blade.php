<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Socile Site') }}</title>
        <script src="https://use.fontawesome.com/595a5020bd.js"></script>
        <!-- Scripts -->
        <script src="{{ asset('public/js/app.js') }}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">-->

<!--        <script src="{{ asset('js/bootstrap.min.js') }}"></script>-->
        <!-- Styles -->
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    </head>
    <body>

        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'homepage') }}
                    </a>
                    @endif
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'homepage') }}
                    </a>
                    @if(Auth::check())
                    <a class="navbar-brand"   href="{{ url('/findfriend') }}">find Friend</a>
                    <a class="navbar-brand"   href="{{  url('/requesters') }}">Friend Requested({{ App\friendships::where('status',NULL)->where('user_requested',Auth::user()->id)->count() }})</a>
                    @endif
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!--                         Left Side Of Navbar 
                                                <ul class="navbar-nav mr-auto">
                        
                                                </ul>
                        
                                                 Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else

                            <li>

                                <a href="{{ url('/friends') }}"><i class="fa fa-users fa-2x" aria-hidden="true" style="margin: 4px"></i></a>
                            </li>
                            <br/><br/>

                            <li class="dropdown">
                                <a id="navbarDropdown"  href="" role="button" data-toggle="dropdown"  aria-expanded="false"> <i class="fa fa-globe fa-2x" aria-hidden="false"></i>
                                    <span class="badge" style="background:red; position: relative; top: -15px; left: -5px ;  border-radius: 50%; ">{{ App\notifications::where('status',1)
                                        ->where('loggedin_user',Auth::user()->id)
                                        ->count() }}
                                    </span>
                                </a>
                                <?php
                                $notification = DB::table('users')
                                        ->LeftJoin('notifications', 'notifications.send_request', '=', 'users.id')
                                        ->where('loggedin_user', Auth::user()->id)
//                                        ->where('status', 1)
                                        ->orderBy('notifications.created_at', 'desc')
                                        ->get();
                                ?>

                                <div class = "dropdown-menu dropdown-menu-right" aria-labelledby = "navbarDropdown" >
                                    @foreach($notification as $n)
                                    <a class = "dropdown-item" href = "{{ url('/notification') }}/{{ $n->id }}" style="padding-left:8px ">

                                        <div class="row"  @if ($n->status ==1)  <?php echo "style=margin-left:-7px;padding:22px;background:#E4E9F2" ?>  @else  <?php echo "style=padding:22px" ?>    @endif>
                                             <div class="col-md-2">
                                                <img src = "{{ asset('public/img')}}/{{ $n->pic }}"  class = "img-circle" alt = "Cinque Terre" width = "50px" height = "50px">
                                            </div>

                                            <div class="col-md-10">
                                                <p style="color:green ; margin-bottom:-7px;  padding-left: 5px;" ><b>{{ $n->name }}</b> {{ $n->note }}</p>
                                                <i style="margin-top: -13px; padding-left: 12px" class="fa fa-users" aria-hidden="false"></i><small style="margin-top: -13px">{{ date('F j,Y',strtotime($n->created_at))  }} at {{ date('H: i',strtotime($n->created_at))  }}</small>
                                            </div>
                                        </div>

                                    </a>
                                    @endforeach
                                </div>

                            </li>
                            <br/><br/>
                            <li>
                                <a>
                                <!--<img src = "{{ asset('public/img')}}/{{ Auth::user()->pic }}" height = "30px" width = "30px" class = "img-circle" > -->
                                    <img src = "{{ asset('public/img')}}/{{ Auth::user()->pic }}" style = "border-radius: 50%" class = "img-circle" alt = "Cinque Terre" width = "30" height = "30">
                                </a>
                            </li>


                            <li class = "nav-item dropdown">
                                <a id = "navbarDropdown" class = "nav-link dropdown-toggle" href = "#" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" v-pre>

                                </a>

                                <div class = "dropdown-menu dropdown-menu-right" aria-labelledby = "navbarDropdown">
                                    <a class = "dropdown-item" href = "{{ route('edit_profile') }}">Edit Profile
                                    </a>
                                    <a class = "dropdown-item" href = "{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a>

                                    <a class = "dropdown-item" href = "{{ route('logout') }}"
                                       onclick = "event.preventDefault();
                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id = "logout-form" action = "{{ route('logout') }}" method = "POST" style = "display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>



                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class = "py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
