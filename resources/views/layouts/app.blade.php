<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/nav.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.6.0.slim.js') }}" ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" defer>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>ToDo</title>


</head>

<body>
@include('sweetalert::alert')
<div id="app" class="flex flex-col justify-between min-h-screen  ">

    <div id="menu_bar" class="header bg-black flex  text-white h-1/6 sm:items-start sm:flex-column md:items-center md:flex-row md:justify-between relative">

        <div id="logo" class="logo p-6 text-3xl flex items-center justify-center" ><a href="{{ route('todos')  }}">ToDos</a></div>
        <div id="NavBarToggle" class="hamburger-div md:hidden">Menu</div>
        <div id="nav" class="logo text-3xl justify-around items-center hidden sm:hidden sm:pl-2  sm:flex-column md:block md:flex lg:flex md:flex-row md:items-center md:justify-center">

                <div class="p-4 text-center"><a href="{{ route('todos') }}" >Home</a></div>
                 @if( !auth()->user() )
                    <div class="p-4 text-center"><a href="{{ route('register') }}" >Register</a></div>
                    <div class="p-4 text-center"><a href="{{ route('login') }}" >Login</a></div>
                @else
                    <div class="p-4 text-center"><a href="{{ route('posts') }}">Posts</a></div>
                    <div class="p-4 text-center"><a href="{{ route('search') }}">Search</a></div>
                    <form action="{{ route('logout') }}" method="POST" class="p-2 my-0 text-center">
                        @csrf
                        <button class="p-4 text-center" type="submit">Logout</button>
                    </form>

                    <div class="avatar w-[150px] h-[150px] items-center justify-center hidden md:flex">
                        <img src ="{{ Storage::url( auth()->user()->avatar ) }}" alt="profile picture" class="max-w-[100%]">
                    </div>

            @endif
        </div>

    </div>

    <div class="body  px-2 py-8 flex-grow">

        @yield('content')

    </div>



</div>

<div class="footer bg-black text-white flex items-center justify-center h-16">
    <div class="flex items-center justify-center md:flex-row md:space-around">
        @if( auth()->user() )
            <p class="px-2">{{auth()->user()->name}}</p>
            <p class="px-2">{{auth()->user()->email}}</p>
        @endif
    </div>
</div>
</body>
{{--<script src="../../../public/js/index.js" defer></script>--}}
<script src="{{ asset('js/index.js') }}" defer></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


</html>
