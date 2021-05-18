<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use HasFactory;
    protected $table = "question";
    public $timestamps = false;

    protected $fillable = [
        "title",
    ];

    public static function create($data) {
        // OwnerUser INT, Body TEXT, DatePost DATE, Title TEXT, Bounty INT, Closed BOOLEAN
        DB::beginTransaction();
        DB::select("CALL create_question(?, ?, ?, ?, ?, ?)",
            [$data['owner'], $data['body'], Carbon::now(), $data['title'], $data['bounty'], "false"]);
        $question = Question::latest('id')->limit(1)->get()[0];
        foreach($data['topics'] as $t_name) {
            $t = Topic::where('name', $t_name)->get()[0];
            DB::insert('INSERT INTO topic_question(id_question, id_topic) VALUES(?, ?)', [$question->id, $t->id]);
        }
        DB::commit();
        return $question;
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
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        $search = "'" . $search . "'";
        return $query->
            selectRaw('question.*, post.*, ts_rank("question".search, plainto_tsquery(?)) as rank_question, ts_rank("user".search, plainto_tsquery(?)) as rank_user', [$search, $search])->
            join('post', 'post.id', '=', 'question.id')->
            join('user', 'user.id', '=', 'post.id_owner')->
            whereRaw('"question".search @@ plainto_tsquery(?) OR "user".search @@ plainto_tsquery(?)', [$search, $search]);
    }
}
