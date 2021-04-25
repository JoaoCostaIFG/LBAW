<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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

    public function posts()
    {
        return $this->hasMany(Post::class, 'id');
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::Class, Post::Class, 'id_owner', 'id', 'id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::Class, Post::Class, 'id_owner', 'id', 'id', 'id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::Class, Post::Class, 'id_owner', 'id', 'id', 'id');
    }

    public function achievements()
    {
        return $this->hasManyThrough(
            Achievement::class,
            Achieved::class,
            'id_user',
            'id',
            'id',
            'id_achievement'
        );
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
