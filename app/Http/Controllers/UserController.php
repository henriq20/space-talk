<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            if ($request->ajax()) {
                return response()->json();
            }

            $request->session()->regenerate();

            return redirect('/');
        }

        return response()->json([
                'errors' => ['password' => ['The password or username is incorrect.']
        ]], 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function store(RegisterRequest $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json();
        }
        
        User::create($request->validated());

        return redirect('/login')->
               with('register_success', 'Your account has been created! You can now log in :)');
    }
}
