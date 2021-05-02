<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        // Authenticated users can create comments
        return Auth::check();
    }

    public function update(User $user, Comment $comment)
    {
        // Authenticated users can create comments
        return $user->id == $comment->post->owner->id || $user->hasRole('moderator');
    }
}
