@extends('layouts.app')

@section('content')

    <div class="md:mx-16 lg:mx-32">
        <div class="search">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="sm:flex md:flex-row items-center overflow-hidden px-2 py-1 justify-between">
                    <input class="text-base flex-grow outline-none px-2 border-2 border-gray-200 h-[40px] rounded my-4 lg:m-0 w-full" name="search" type="text" placeholder="Search" value="{{ old('search') }}" />
                    <div class=" m-4 lg:my-0 ms:flex items-center px-2 rounded-lg space-x-4 mx-auto ">
                        <button class="bg-indigo-500 text-white text-base rounded-lg px-4 py-2 font-thin">Search</button>
                    </div>
                </div>
            </form>
        </div>


        @if( $todos->count() )


            @foreach( $todos as $todo )

                <div class="container my-3 mx-0 md:mx-4 text-3xl border rounded-md border-gray-200 p-6 {{ $todo->isCompleted() ? "bg-gray-300" : '' }}">

                        <div class="flex justify-between">

                        <div>
                            <form action="{{ route('todos.complete', $todo->id) }}" method="POST" id="checkboxForm">
                                @csrf
                                <input type="checkbox"  name="completed" id="{{$todo->id}}" class="markCompleted text-4xl accent-indigo-500 scale-150" {{ $todo->isCompleted() ? 'Checked' : '' }} >
                            </form>
                        </div>

                        <div class="flex">
                            @if( $todo->status == 'incomplete' )
                                <span class="px-2"><a href="{{ route('todos.edit', $todo) }}">Edit</a></span>
                            @endif
                            <span class="px-2">
                                    <form action="{{ route('todos.remove', $todo) }}" method="POST">
                                        @csrf
                                        <button type="submit">Delete</button>
                                    </form>
                                </span>
                        </div>
                    </div>

                    <div>

                        @if( $todo->status == 'completed' )
                            <strike><p>{{ $todo->text }}</p></strike>
                        @else
                            <p>{{ $todo->text }}</p>
                        @endif

                        <p>Created on: {{ $todo->present()->date_created }}</p>
                        @if( $todo->status == 'completed' )
                            <p>Completed: {{ $todo->present()->date_updated }}</p>
                        @endif
                        <p>Status: {{ $todo->status }}</p>

                    </div>
                </div>
            @endforeach

        @else
            <div class="container mx-auto text-xl mt-6 ">
                <h4>No Match</h4>
            </div>
        @endif
    </div>

@endsection
