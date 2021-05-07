<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use HasFactory;
    protected $table = "question";
    public $timestamps = false;

    public static function create($data) {
        // OwnerUser INT, Body TEXT, DatePost DATE, Title TEXT, Bounty INT, Closed BOOLEAN
        DB::beginTransaction();
        DB::select("CALL create_question(?, ?, ?, ?, ?, ?)", 
            [$data['owner'], $data['body'], date("Y-m-d"), $data['title'], $data['bounty'], "false"]);
        $question = Question::latest('id')->limit(1);
        DB::commit();
        return $question->get()[0];
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
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

        return $query->
            selectRaw('*, ts_rank("question".search, plainto_tsquery(?)) as rank_question, ts_rank("user".search, plainto_tsquery(?)) as rank_user', [$search, $search])->
            join('post', 'post.id', '=', 'question.id')->
            join('user', 'user.id', '=', 'post.id_owner')->
            whereRaw('"question".search @@ to_tsquery(?) OR "user".search @@ to_tsquery(?)', [$search, $search]);
    }
}
