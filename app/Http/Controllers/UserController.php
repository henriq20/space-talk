<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function profile($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return view('users.profile', ['user' => $user]);
    }
}
