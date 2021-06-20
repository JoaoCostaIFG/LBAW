<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notification";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notification_achievement()
    {
        return $this->hasOne(NotificationAchievement::class,  'id', 'id');
    }

    public function notification_post()
    {
        return $this->hasOne(NotificationPost::class, 'id', 'id');
    }

}
