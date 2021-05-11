<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $user_model)
    {
        // Users can update their own information
        return $user->id === $user_model->id;
    }
}
