<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $user_model)
    {
        // Users can update their own information
        return $user->id === $user_model->id;
    }

    public function report(User $user, User $user_model){
        // Authenticated users can report users
        return Auth::check() && $user->id !== $user_model->id;
    }

    public function ban(User $user, User $user_model){
        // Authenticated users can report users
        return Auth::check() && $user->id !== $user_model->id && $user->hasRole('administrator');
    }
}
