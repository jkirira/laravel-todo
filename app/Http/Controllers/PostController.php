<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;



class PostController extends Controller
{

    public function __construct(){
        $client = new Client([ 'base_uri' => 'https://jsonplaceholder.typicode.com',]);
    }


    public function index()
    {
        return view('posts');
    }

    public function store(Request $request){

    }

    public function get(Request $request){
        $client = new Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        return $response->getBody();
    }

    public function getId(Request $request) {
        $client = new Client();
        $response = $client->request('GET', '/posts/'.$request->tag );
        return $response->getBody();
    }


    public function add(Request $request){
        $client = new Client();
        $response = $client->request('POST', 'https://jsonplaceholder.typicode.com/posts', [
            'form_params' => [
                'title' => $request->title,
                'body' => $request->body,
                'userId' => $request->userId
            ]
        ]);
        return $response->getBody();
    }

    public function edit(Request $request){
        $client = new Client();
        $response = $client->request('PUT', 'https://jsonplaceholder.typicode.com/posts/'.$request->postId, [
            'form_params' => [
                'title' => $request->title,
                'body' => $request->body,
                'userId' => $request->userId
            ]
        ]);

        return $response->getBody();
    }

    public function delete($id){
        $client = new Client();
        $response = $client->request('DELETE', 'https://jsonplaceholder.typicode.com/posts/'.$id);
        return $response->getBody();
    }
}
