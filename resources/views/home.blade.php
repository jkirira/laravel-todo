@extends('layouts.app')

@section('content')

            <div class="flex ">
                <div class="container mx-auto">
                    <div class="max-w-md mx-auto mb-10 bg-white p-5 rounded-md shadow-sm">

                        <div class="text-center">
                            <h1 class="my-3 text-3xl font-semibold text-gray-700">Add Task</h1>
                        </div>

                        <div class="m-7">

                            @if(session()->get( 'success' ))
                                <div class=" border border-green-500 text-green-500 rounded p-2 m-2">{{ session()->get( 'success' ) }}</div>
                            @endif

                            @if(session()->get( 'error' ))
                                <div class=" border border-red-500 text-red-500 rounded p-2 m-2">{{ session()->get( 'error' ) }}</div>
                            @endif

                            <form action="{{ route('todos') }}" method="POST" id="form">
                                @csrf
                                <div class="mb-6">
                                    <input type="text" name="text" id="text" placeholder="Task" value="{{ old('text') }}" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " required>
                                </div>
                                <div class="mb-6">
                                    <button type="submit" class="w-full p-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none text-2xl">+</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>



    @if( $todos->count() )

        @foreach( $todos as $todo )
            <div class="container my-3 mx-auto text-3xl	border rounded-md border-gray-200 p-6 {{ $todo->isCompleted() ? "bg-gray-300" : '' }}">

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

                                <button class="deleteButton" type="submit">Delete</button>
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

        <div class="m-auto w-[70%]">
            {{ $todos->links() }}
        </div>


    @else
        <div class="container mx-auto flex items-center justify-center text-xl">
            <h4>You have no ToDos</h4>
        </div>
    @endif

@endsection
<script src="{{ asset('js/jquery-3.6.0.slim.js') }}" ></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.deleteButton').on('click', function (event) {
            event.preventDefault();
            const fm = $(this.form)
            swal({
                title: 'Are you sure?',
                text: 'This action is irreversible!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function (value) {
                if (value) {
                    fm.submit();
                }
            });
        });
    });
</script>
