<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function authenticate(LoginRequest $request)
    {

    }

    public function store(RegisterRequest $request)
    {
        // Returns an empty JSON if the request is an AJAX call.
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json();
        }
        
        $user = new User($request->input());
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/login')->
               with('register_success', 'Your account has been created! You can now log in :)');
    }
}
