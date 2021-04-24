<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = "question";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function post()
    {
        return $this->hasOne(Post::class, 'id');
    }

    // search brought to you by https://matthewdaly.co.uk/blog/2017/12/02/full-text-search-with-laravel-and-postgresql/
    // TODO add topic search here
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->whereRaw('search @@ to_tsquery(?)', [$search])->
            orderByRaw('ts_rank(search, plainto_tsquery(?)) DESC', [$search]);
    }
}
