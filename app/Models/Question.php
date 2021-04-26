<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = "question";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function post()
    {
        return $this->hasOne(Post::class, 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_question');
    }

    public function answers()
    {
        return $this->hasManyThrough(
            Answer::class,
            AnswerQuestion::class,
            'id_question',
            'id',
            'id',
            'id_answer'
        );
    }

    public function topics()
    {
        return $this->hasManyThrough(
            Topic::class,
            TopicQuestion::class,
            'id_question',
            'id',
            'id',
            'id_topic'
        );
    }

    // search brought to you by https://matthewdaly.co.uk/blog/2017/12/02/full-text-search-with-laravel-and-postgresql/
    // TODO add topic search here
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->join('post', 'post.id', '=', 'question.id')->
            join('user', 'user.id', '=', 'post.id_owner')->
            whereRaw('"question".search @@ to_tsquery(?) OR "user".search @@ to_tsquery(?)', [$search, $search])->
            orderByRaw('ts_rank("question".search, plainto_tsquery(?)) DESC', [$search])->
            orderByRaw('ts_rank("user".search, plainto_tsquery(?)) DESC', [$search]);
    }
}
