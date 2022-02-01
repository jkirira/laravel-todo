<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;



class PostController extends Controller
{
    public function index()
    {
        return view('posts');
    }

    public function store(Request $request){

    }

    public function get(Request $request){
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        return $response->json();
    }

    public function getId(Request $request) {
        $URL = 'https://jsonplaceholder.typicode.com/posts/' + $request->tag;
        $response = Http::get($URL);
        return $response->json();
    }


    public function add(Request $request){
        $response = Http::post( 'https://jsonplaceholder.typicode.com/posts', $request->only('title', 'body', 'userId'));
        return $response->json();
    }

    public function edit(Request $request){
        $response = Http::put( 'https://jsonplaceholder.typicode.com/posts/'.$request->postId, $request->only('title', 'body', 'userId'));
        return $response->json();
    }

    public function delete(Request $request){
        $response = Http::delete( 'https://jsonplaceholder.typicode.com/posts/'.$request->only('postId'));
        return $response->json();
    }
}
