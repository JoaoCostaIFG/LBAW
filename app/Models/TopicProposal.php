<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicProposal extends Model
{
    use HasFactory;

    protected $table = "topic_proposal";
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function id_admin()
    {
        return $this->hasOne(User::class, 'id', 'id_admin');
    }

    public function scopePending($query) {
        return $query->whereNull('id_admin');
    }
}

