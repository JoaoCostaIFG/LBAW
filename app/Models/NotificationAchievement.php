<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAchievement extends Model
{
    use HasFactory;
    protected $table = "notification_achievement";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'id');
    }

    public function achievement()
    {
        return $this->hasOne(Achievement::class, 'id', 'id_achievement');
    }
}
