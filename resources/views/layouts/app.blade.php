<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}" defer></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <title>ToDo</title>


</head>

<body>
<div id="app" class="flex flex-col h-full justify-between">

    <div class="header bg-black flex justify-between text-white h-1/6 items-center">

        <div class="logo p-6 text-3xl" ><a href="{{ route('todos')  }}">ToDos</a></div>
        <div class="logo text-3xl flex justify-around items-center">

            @if( !auth()->user() )
                <div class="p-4"><a href="{{ route('register') }}" >Register</a></div>
                <div class="p-4"><a href="{{ route('login') }}" >Login</a></div>
            @else
                <div class="p-4"><a href="{{ route('posts') }}">Posts</a></div>
                <div class="p-4"><a href="{{ route('search') }}" >Search</a></div>
                <form action="{{ route('logout') }}" method="POST" class="p-2">
                    @csrf
                    <button class="p-4" type="submit">Logout</button>
                </form>

                <div class="w-[150px] h-[150px] rounded-circle">
                    <img src ="{{ Storage::url( auth()->user()->avatar ) }}" alt="profile picture" class="max-w-[100%]">
                </div>

            @endif
        </div>

    </div>

{{--    <h1>Hello, {{ auth()->user()->present()->name() }}</h1>--}}

    <div class="body h-full px-2 py-8 flex-grow">

        @yield('content')

    </div>

    <div class="footer bg-black text-white">
        <div class="">
            <p>James Kirira</p>
            <p>jkirira@cytonn.com</p>
        </div>
    </div>

</div>
</body>
</html>
