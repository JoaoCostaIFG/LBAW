<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicQuestion extends Model
{
    use HasFactory;

    protected $table = "topic_question";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function question()
    {
        return $this->hasOne(Question::class, 'id', 'id_question');
    }

    public function topic()
    {
        return $this->hasOne(Topic::class, 'id', 'id_topic');
    }
}
