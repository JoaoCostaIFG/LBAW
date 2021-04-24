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
}
