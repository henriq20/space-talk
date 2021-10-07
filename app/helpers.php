<?php

use App\Models\User;

/**
 * Gets the currently authenticated user.
 * @return User|null The user if logged in; otherwise, null.
 */
function user(): User
{
    return auth()->user();
}
