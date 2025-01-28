<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function admin(User $user): Response
    {
        return $user->role === 'petugas'
            ? Response::allow()
            : Response::deny('You are not authorized to access this resource.');
    }
}
