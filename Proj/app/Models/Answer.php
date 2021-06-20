<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Answer extends Model
{
    use HasFactory;
    protected $table = "answer";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function parentQuestion() {
            return $this->question();
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_answer');
    }

    public function question()
    {
        return $this->hasOneThrough(
            Question::class,
            AnswerQuestion::class,
            'id_answer',
            'id',
            'id',
            'id_question');
    }

    public static function createAnswer($request) {
        DB::transaction(function () use ($request) {
            DB::select("CALL create_answer(?, ?, ?, ?)", [Auth::id(), $request->body, Carbon::now(), $request->id]);
            return Answer::latest('id')->limit(1);
        });
    }
}

