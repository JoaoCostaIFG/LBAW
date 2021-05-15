<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        // Moderator users can accept/reject edit proposals
        return $user->hasRole('moderator');
    }
}
