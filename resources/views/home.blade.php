@extends('layouts.app')

@section('content')

            <div class="flex ">
                <div class="container mx-auto">
                    <div class="max-w-md mx-auto mb-10 bg-white p-5 rounded-md shadow-sm">

                        <div class="text-center">
                            <h1 class="my-3 text-3xl font-semibold text-gray-700">Add Task</h1>
                        </div>

                        <div class="m-7">

                            @if(session('status'))
                                <div class=" border border-red-500 text-red-500 rounded-md px-4  py-6">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ route('todos') }}" method="POST" id="form">
                                @csrf
                                <div class="mb-6">
                                    <input type="text" name="text" id="text" placeholder="Task" value="{{ old('message') }}" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                                </div>
                                <div class="mb-6">
                                    <button type="submit" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Add Task</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>



    @if( $todos->count() )

        @foreach( $todos as $todo )
            <div class="container my-3 mx-auto text-3xl	border rounded-md border-gray-200 p-6">
                <div class="flex justify-end">
                    <span class="px-2"><a href="{{ route('todos.edit', $todo) }}">Edit</a></span>
                    <span class="px-2">
                        <form action="{{ route('todos.remove', $todo) }}" method="POST">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </span>
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

        {{ $todos->links() }}

    @else
        <div class="container mx-auto flex items-center justify-center text-xl">
            <h4>You have no ToDos</h4>
        </div>
    @endif
@endsection
