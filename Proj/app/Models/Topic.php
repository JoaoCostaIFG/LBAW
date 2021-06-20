<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table = "topic";

    protected $hidden = [
        'search'
    ];

    protected $fillable = [
        'name'
    ];

    // Don't add create and update timestamps in database.
    public $timestamps = false;
}

