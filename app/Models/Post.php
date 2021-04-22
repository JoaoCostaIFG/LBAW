<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "post";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * TODO this won't work, use morph instead
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'id_owner');
    }
}
