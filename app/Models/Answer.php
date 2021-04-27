<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = "answer";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function getQuestionIdAttribute() {
            return $this->question->id;
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
}

