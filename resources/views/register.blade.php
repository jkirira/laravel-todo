@extends('layouts.app')

@section('content')
    <div class="flex items-center ">
        <div class="container bg-red mx-auto border-gray-700">
            <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm border border-gray-700">

                <div class="text-center">
                    <h1 class="my-3 text-3xl font-semibold text-gray-700 -200">Register</h1>
                </div>

                <div class="m-7">
                    <form action="{{ route('register') }}" method="POST" id="form">
                        @csrf
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm text-gray-600">UserName</label>
                            <input type="text" name="name" id="name" placeholder="Username" value="{{ old('name') }}" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " />
                            @error('username')
                            <div>
                                {{message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm text-gray-600">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="email" value="{{ old('email') }}" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " />
                            @error('email')
                            <div>
                                {{message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="password" class="text-sm text-gray-600">Password</label>
                            <input type="text" name="password" id="password" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 " />
                            @error('password')
                            <div>
                                {{message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <button type="submit" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Send Message</button>
                        </div>
                        <p class="text-base text-center text-gray-400" id="result">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
