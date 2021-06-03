<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
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

        return Comment::createComment($request);
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
