<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Creates a new comment.
     *
     * @return boolean The creation of a comment was successful
     */
    public function create(Request $request)
    {
        if(!Auth::check()){
            return null;
        }

        if(!(is_null($request->question_id) xor is_null($request->answer_id))){
            return null;
        }

        // create_comment(OwnerUser INT, Body TEXT, DatePost DATE, IdQuestion INT, IdAnswer INT)
        $comment = DB::transaction(function () use ($request){
            if(is_null($request->question_id)){
                DB::select("CALL create_comment(?, ?, ?, ?, ?)", [Auth::id(), $request->body, date("Y-m-d"), $request->question_id, null]);
            } else if(is_null($request->answer_id)) {
                DB::select("CALL create_comment(?, ?, ?, ?, ?)", [Auth::id(), $request->body, date("Y-m-d"), null, $request->answer_id]);
            }
            return Comment::latest('id')->first();
        });

        return $comment;
    }
}
