<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href={{asset("css/bootstrap.min.css") }} />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href={{asset("css/font-awesome.min.css") }}>

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href={{asset("css/style.css") }} />
    </head>
    <body class="antialiased">

        <nav>
            @guest
                <a href="{{url('/register')}}">register</a>
                <a href="{{url('/login')}}">login</a>
            @endguest

            @auth
                <form action="{{url('/logout')}}" method="POST">
                    @csrf
                    <input type="submit" value="logout">
                </form>
            @endauth
        </nav>

        @yield('content')

        <script type="text/javascript" src={{asset("js/jquery.min.js") }}></script>
        <script type="text/javascript" src={{asset("js/bootstrap.min.js") }}></script>
    </body>
</html>
