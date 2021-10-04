<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        if ($request->ajax()) {
            return response()->json();
        }
        
        User::create($request->validated());

        return redirect('/login')->
               with('action_success', 'Your account has been created! You can now log in :)');
    }
}
