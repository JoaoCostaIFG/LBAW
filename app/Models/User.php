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

    // Relations

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_owner', 'id');
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

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id', 'id');
    }

    // Search functions

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->whereRaw('search @@ to_tsquery(?)', [$search])->
            orderByRaw('ts_rank(search, plainto_tsquery(?)) DESC', [$search]);
    }

    public function hasRole($role) {
        if (DB::table('administrator')->where('id', $this->id)->exists() && ($role === 'administrator' || $role === 'moderator')) {
            return true;
        }
        if (DB::table('moderator')->where('id', $this->id)->exists() && $role === 'moderator') {
            return true;
        }
        return false;
    }

    public function getTopicParticipation()
    {
        $query = DB::query()->fromSub(function ($q) {
                $questions_topic = Topic::selectRaw('topic.id as topic_id, post.id as post_id, post.score as score')
                    ->join('topic_question', 'topic.id', '=', 'topic_question.id_topic')
                    ->join('question', 'question.id', '=', 'topic_question.id_question')
                    ->join('post', 'post.id', '=', 'question.id')
                    ->join('user', 'user.id', '=', 'post.id_owner')
                    ->where('user.id', '=', $this->id);

                $q->from('topic')->
                    selectRaw('topic.id as topic_id, post.id as post_id, post.score as score')
                    ->join('topic_question', 'topic.id', '=', 'topic_question.id_topic')
                    ->join('question', 'question.id', '=', 'topic_question.id_question')
                    ->join('answer_question', 'question.id', '=', 'answer_question.id_question')
                    ->join('answer', 'answer.id', '=', 'answer_question.id_answer')
                    ->join('post', 'post.id', '=', 'answer.id')
                    ->join('user', 'user.id', '=', 'post.id_owner')
                    ->where('user.id', '=', $this->id)->union($questions_topic);
            }, 'table')
            ->selectRaw('topic_id, count(post_id) as cnt, sum(score) as score')
            ->groupBy('topic_id')
            ->orderBy('cnt', 'desc');

        return $query->get();
    }

}
