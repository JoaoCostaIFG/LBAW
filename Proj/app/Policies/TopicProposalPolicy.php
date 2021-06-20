<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicProposalPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        // Admin users can accept/reject topic proposals
        return $user->hasRole('administrator');
    }
}
