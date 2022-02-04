<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $path = null;

        if( $request->file('image') ){
            $path = Storage::putFile('public/images', $request->file('image'));
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $path ? $path : ''
        ]);


        auth()->attempt([
            'email' =>$request->email,
            'password' =>$request->password
        ]);

        return redirect()->route('todos');

    }

}
