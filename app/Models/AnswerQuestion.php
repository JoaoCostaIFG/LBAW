<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerQuestion extends Model
{
    use HasFactory;

    protected $table = "answer_question";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * TODO this won't work, use morph instead
     */
    public function question()
    {
        return $this->hasOne(Question::class, 'id', 'id_question');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'id', 'id_answer');
    }
}
