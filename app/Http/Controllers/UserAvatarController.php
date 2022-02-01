<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    public function store(Request $request){
        $path = $request->file('avatar')->storeAs('avatars', $request->user()->id);
        return $path;
    }
}
