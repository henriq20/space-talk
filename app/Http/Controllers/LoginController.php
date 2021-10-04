<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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

            return redirect()->intended();
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

        return redirect('/login');
    }
}
