<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $table = "achievement";

    // Don't add create and update timestamps in database.
    public $timestamps = false;
}
