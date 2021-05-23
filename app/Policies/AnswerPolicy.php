<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        // Authenticated users can create answer
        return Auth::check();
    }

    public function update(User $user, Answer $answer)
    {
        // Authenticated users can create comments
        return $user->id == $answer->post->owner->id || $user->hasRole('moderator');
    }
}
