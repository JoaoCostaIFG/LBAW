<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = "vote";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'id_post');
    }

    public function isUpvote()
    {
        return $this->value == 1;
    }
}

