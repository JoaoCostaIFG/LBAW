<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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

    public function hasRole($role) {
        if (DB::table('administrator')->where('id', $this->id)->exists() && ($role === 'administrator' || $role === 'moderator')) {
            return true;
        }
        if (DB::table('moderator')->where('id', $this->id)->exists() && $role === 'moderator') {
            return true;
        }
        return false;
    }

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

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id', 'id');
    }
}
