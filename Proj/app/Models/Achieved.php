<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achieved extends Model
{
    use HasFactory;

    protected $table = "achieved";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function achievement()
    {
        return $this->hasOne(Achievement::class, 'id', 'id_achievement');
    }
}
