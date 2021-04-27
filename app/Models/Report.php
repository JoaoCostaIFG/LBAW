<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = "report";
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'reporter');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'id_post');
    }

    public function scopePending($query) {
        return $query->where('state', 'pending');
    }
}

