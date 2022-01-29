<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>ToDo</title>

</head>

<body>
<div class="h-screen">
    <div class="header bg-black flex justify-between text-white h-1/6 items-center">

        <div class="logo p-6 text-3xl" ><a href="{{ route('todos')  }}">ToDos</a></div>
        <div class="logo p-6 text-3xl flex justify-around">

            @if( !auth()->user() )
                <div class="p-2"><a href="{{ route('register') }}" >Register</a></div>
                <div class="p-2"><a href="{{ route('login') }}" >Login</a></div>
            @else
                <div class="p-2"><a href="{{ route('search') }}" >Search</a></div>
                <form action="{{ route('logout') }}" method="POST" class="p-2">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endif
        </div>

    </div>

    <div class="body h-full px-2 py-8">

        @yield('content')

    </div>

    <div class="footer">
        <div class="">
            <p>James Kirira</p>
            <p>jkirira@cytonn.com</p>
        </div>
    </div>

</div>
<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
