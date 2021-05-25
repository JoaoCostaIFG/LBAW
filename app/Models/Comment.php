<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comment";

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    public function parentQuestion() {
        if ($this->question()->exists())
            return $this->question();
        else // if ($this->answer()->exists())
            return $this->answer->question();
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
    }

    protected function question()
    {
        return $this->hasOne(Question::class, 'id', 'id_question');
    }

    protected function answer()
    {
        return $this->hasOne(Answer::class, 'id', 'id_answer');
    }

    public function parent() {
        if ($this->question()->exists())
            return $this->question();
        else // if ($this->answer()->exists())
            return $this->answer();
    }

    public static function createComment($request) {
        $comment = DB::transaction(function () use ($request){
            if($request->has('question_id')){
                DB::select("CALL create_comment(?, ?, ?, ?, ?)", [Auth::id(), $request->body, Carbon::now(), $request->question_id, null]);
            } else {
                DB::select("CALL create_comment(?, ?, ?, ?, ?)", [Auth::id(), $request->body, Carbon::now(), null, $request->answer_id]);
            }
            return Comment::latest('id')->limit(1);
        });

        return $comment->with('post')->get()[0];
    }
}
