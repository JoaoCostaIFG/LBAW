<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    private function question()
    {
        return $this->hasOne(Question::class, 'id', 'id');
    }

    private function answer()
    {
        return $this->hasOne(Answer::class, 'id', 'id');
    }

    private function comment()
    {
        return $this->hasOne(Comment::class, 'id', 'id');
    }

    public function child() {
        if ($this->question()->exists())
            return $this->question();
        else if ($this->answer()->exists())
            return $this->answer();
        else // if ($this->comment()->exists()) -> Not needed
            return $this->comment();
    }
}
