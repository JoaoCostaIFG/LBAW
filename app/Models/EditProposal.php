<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditProposal extends Model
{
    use HasFactory;

    protected $table = "edit_proposal";
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'id_post');
    }

    public function scopePending($query) {
        return $query->whereNull('id_moderator');
    }
}

