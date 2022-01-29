@extends('layouts.app')

@section('content')

    <div class="search">
        <form action="{{ route('search') }}" method="POST">
            @csrf
            <div class="sm:flex items-center bg-white rounded-lg overflow-hidden px-2 py-1 justify-between border-2 border-gray-200">
                <input class="text-base flex-grow outline-none px-2 " name="search" type="text" placeholder="Search" value="{{ old('search') }}" />
                <div class="ms:flex items-center px-2 rounded-lg space-x-4 mx-auto ">
                    <button class="bg-indigo-500 text-white text-base rounded-lg px-4 py-2 font-thin">Search</button>
                </div>
            </div>
        </form>
    </div>


    @if( $todos->count() )

        @foreach( $todos as $todo )
            <div class="container my-3 mx-auto text-3xl	border rounded-md border-gray-200 p-6">
                <div class="flex justify-end">
                    <span class="px-2"><a href="{{ route('todos.edit', $todo) }}">Edit</a></span>
                    <span class="px-2"><a href="{{ route('todos.remove', $todo->id) }}">Delete</a></span>
                </div>
                <div>
                    <form action="{{ route('todos.complete', $todo->id) }}" method="POST" id="checkboxForm">
                        @csrf
                    </form>
                    <input type="checkbox"  name="completed" id="markCompleted" class="text-4xl accent-indigo-500" {{ $todo->isCompleted() ? 'Checked' : '' }} ">

                    @if( $todo->status == 'completed' )
                        <strike><p>{{ $todo->text }}</p></strike>
                    @else
                        <p>{{ $todo->text }}</p>
                    @endif

                    <p>Date Created: {{ $todo->created_at }}</p>
                    <p>Status: {{ $todo->status }}</p>

                </div>
            </div>
        @endforeach

    @else
        <div class="container mx-auto text-xl mt-6 ">
            <h4>No Match</h4>
        </div>
    @endif

@endsection
