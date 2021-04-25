<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = "user";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'username', 'password', 'email'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id');
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Post::class, 'id_owner', 'id', 'id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Post::class, 'id_owner', 'id', 'id', 'id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class, 'id_owner', 'id', 'id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->whereRaw('search @@ to_tsquery(?)', [$search])->
            orderByRaw('ts_rank(search, plainto_tsquery(?)) DESC', [$search]);
    }
}
