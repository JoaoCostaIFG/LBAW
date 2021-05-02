<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AjaxController extends Controller
{
    /**
     * Creates a new comment.
     *
     * @return boolean The creation of a comment was successful
     */
    public function add_comment(Request $request)
    {

        $comment_controller = new CommentController();
        $comment = $comment_controller->create($request);


        // $comment = App::call('App\Http\Controllers\CommentController@create', ['request' => $request]);

        if(is_null($comment)){
            return "<p id=\"comment-error\" class=\"text-danger\">An error occurred while processing your request</p>";
        }
        return view('partials.posts.comment', ['comment' => $comment]);
    }
}
