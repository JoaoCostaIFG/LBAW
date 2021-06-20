<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPost extends Model
{
    use HasFactory;
    protected $table = "notification_post";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'id');
    }

    public function question()
    {
        return $this->hasOne(Question::class, 'id', 'id_post');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'id', 'id_post');
    }
}
