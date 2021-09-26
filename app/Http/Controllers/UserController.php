<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class UserController extends Controller
{
    public function authenticate()
    {
        
    }

    public function store(RegisterRequest $request)
    {
        $user = new User($request->input());
        $user->save();

        return redirect('/login');
    }
}
