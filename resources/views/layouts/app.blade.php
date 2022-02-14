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

    <div id="menu_bar" class="header bg-black flex flex-col text-white h-1/6 items-start md:items-center md:flex-row md:justify-between relative">

        <div id="logo" class="logo w-full p-6 text-3xl flex md:items-center relative " >
            <a href="{{ route('todos')  }}" class="hover:no-underline">
                <div class="p-4 hover:bg-white hover:text-black text-center">
                    ToDos
                </div>
            </a>
            <div id="NavBarToggle" class="hamburger-div md:hidden">Menu</div>
        </div>

        <div id="nav" class="logo text-3xl justify-around items-center hidden sm:pl-2  sm:flex-column md:block md:flex lg:flex md:flex-row md:items-center md:justify-center">

            <a class="no-underline" href="{{ route('todos') }}" ><div class="p-4 hover:bg-white hover:text-black text-center">Home</div></a>
                 @if( !auth()->user() )
                <a class="no-underline" href="{{ route('register') }}" ><div class="p-4 text-center hover:bg-white hover:text-black">Register</div></a>
        <a class="no-underline" href="{{ route('login') }}" ><div class="p-4 text-center hover:bg-white hover:text-black">Login</div></a>
                @else
        <a class="no-underline" href="{{ route('posts') }}"><div class="p-4 text-center hover:bg-white hover:text-black">Posts</div></a>
<a class="no-underline" href="{{ route('search') }}"><div class="p-4 text-center hover:bg-white hover:text-black">Search</div></a>
                    <form action="{{ route('logout') }}" method="POST" class="p-2 my-0 text-center">
                        @csrf
                        <button class="p-4 text-center hover:bg-white hover:text-black" type="submit">Logout</button>
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
