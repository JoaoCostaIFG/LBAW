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
        // create_comment(OwnerUser INT, Body TEXT, DatePost DATE, IdQuestion INT, IdAnswer INT)
        $comment = DB::transaction(function () use ($request){
            if(isset($request->question_id)){
                DB::select("CALL create_comment(?, ?, ?, ?, ?)", [Auth::id(), $request->body, date("Y-m-d"), null, $request->answer_id]);
            } else if (isset($request->answer_id)) {
                DB::select("CALL create_comment(?, ?, ?, ?, ?)", [Auth::id(), $request->body, date("Y-m-d"), $request->question_id, null]);
            }
            return Comment::latest('id')->first();
        });

        return $comment;
    }
}
