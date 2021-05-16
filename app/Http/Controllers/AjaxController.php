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

        if(is_null($comment)){
            return "<p id=\"comment-error\" class=\"text-danger\">An error occurred while processing your request</p>";
        }
        return view('partials.posts.comment', ['comment' => $comment]);
    }

    public function proccess_edit_proposal(Request $request)
    {
        $proposal_controller = new EditProposalController();
        $proposal_controller->update($request);        
    }

    public function proccess_topic_proposal(Request $request)
    {
        $proposal_controller = new TopicProposalController();
        $proposal_controller->update($request);       
    }
}