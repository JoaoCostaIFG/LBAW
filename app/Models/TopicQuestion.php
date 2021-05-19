<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopicQuestion extends Model
{
    use HasFactory;

    protected $table = "topic_question";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public static function create($data) {
        DB::insert('insert into topic_question (id_question, id_topic) values (?, ?)',
         [$data['id_question'], $data['id_topic']]);
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
