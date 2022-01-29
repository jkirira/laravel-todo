<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $authenticated = auth()->attempt([ 'email' =>$request->email, 'password' =>$request->password, ]);

        if( !$authenticated ){
            return back()->with('status', 'Invalid Login Details');
        }

        return redirect()->route('todos');

    }

}
