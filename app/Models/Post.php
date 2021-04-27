<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // TODO Store type in constructor
    use HasFactory;

    protected $table = "post";
    private $child;

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function getChildAttribute()
    {
        if (empty($this->child)) {
            if ($this->question()->exists())
                $this->child = $this->question();
            else if ($this->answer()->exists())
                $this->child = $this->answer();
            else if ($this->comment()->exists()) // -> Not needed
                $this->child = $this->comment();
            else
                return $this->child->get()[0];
        }

        return $this->child->get()[0];
    }

    public function getTypeAttribute() {
        return $this->getChildAttribute()->getTable();
    }

    public function parentQuestion() {
        if ($this->getTypeAttribute() == "question")
            return $this->question();
        return $this->getChildAttribute()->parentQuestion();
    }

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

    protected function question()
    {
        return $this->hasOne(Question::class, 'id', 'id');
    }

    protected function answer()
    {
        return $this->hasOne(Answer::class, 'id', 'id');
    }

    protected function comment()
    {
        return $this->hasOne(Comment::class, 'id', 'id');
    }
}
