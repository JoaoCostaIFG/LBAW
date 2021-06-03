<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Vote extends Model
{
    use HasFactory;

    protected $table = "vote";

    protected $fillable = [
        'id_post', 'id_user', 'value'
    ];

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

    public static function create($request)
    {
        return DB::insert(
            'INSERT INTO "vote" (id_post, id_user, value) VALUES(?, ?, ?)',
            [$request->post_id, Auth::id(), $request->value]
        );
    }

    public static function deleteVote($request)
    {
        return DB::delete(
            'DELETE FROM "vote" WHERE id_post = ? AND id_user = ?',
            [$request->post_id, Auth::id()]
        );
    }
}
