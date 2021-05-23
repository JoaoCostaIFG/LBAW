<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{

    /**
     * Get a validator for an incoming comment add request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'question_id' => 'required_without:answer_id',
            'answer_id' => 'required_without:question_id',
            'body' => 'required|string',
        ]);
    }

    /**
     * Creates a new comment.
     *
     * @return boolean The creation of a comment was successful
     */
    public function create(Request $request)
    {

        $this->authorize('create', Comment::class);

        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return null;
        }

        // create_comment(OwnerUser INT, Body TEXT, DatePost DATE, IdQuestion INT, IdAnswer INT)
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

    public function update(Request $request)
    {        
        $validation = Validator::make($request->all(), [
            'id' => 'required|exists:comment,id',
            'body' => 'required|string',
        ]);

        $comment = Comment::find($request->id);
        $this->authorize('update', $comment);

        $comment->post->update(['body' => $request->body]);
    }
}
