<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = "answer";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function post()
    {
        return $this->hasOne(Post::class, 'id');
    }
}

