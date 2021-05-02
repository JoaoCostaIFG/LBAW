<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comment";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function parentQuestion() {
        if ($this->question()->exists())
            return $this->question();
        else // if ($this->answer()->exists())
            return $this->answer->question();
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
    }

    protected function question()
    {
        return $this->hasOne(Question::class, 'id', 'id_question');
    }

    protected function answer()
    {
        return $this->hasOne(Answer::class, 'id', 'id_answer');
    }

    public function parent() {
        if ($this->question()->exists())
            return $this->question();
        else // if ($this->answer()->exists())
            return $this->answer();
    }
}
