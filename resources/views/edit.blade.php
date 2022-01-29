@extends('layouts.app')

@section('content')

    @if( $todo )

        <div class="flex ">
        <div class="container mx-auto">
            <div class="max-w-md mx-auto mb-10 bg-white p-5 rounded-md shadow-sm">

                <div class="text-center">
                    <h1 class="my-3 text-3xl font-semibold text-gray-700">Edit Task</h1>
                </div>

                <div class="m-7">

                    @if(session('status'))
                        <div class=" border border-red-500 text-red-500 rounded-md px-4  py-6">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('todos.update', $todo) }}" method="POST" id="form">
                        @csrf
                        <div class="mb-6">
                            <input type="text" name="text" id="text" placeholder="Task" value="{{ $todo->text }}" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                        </div>
                        <div class="mb-6">
                            <button type="submit" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Save</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    @else
        <div class="container mx-auto text-xl">
            <h4>An Error Ocurred</h4>
        </div>
    @endif

@endsection
