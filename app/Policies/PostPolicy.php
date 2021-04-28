<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Post $post)
    {
      // User can only create items in cards they own
      return Auth::check();
    }
}
