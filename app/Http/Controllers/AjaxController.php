<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

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
            return view('errors.comment_ajax_error');
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

    public function proccess_user_report(Request $request)
    {
        $report_controller = new ReportController();
        $report_controller->process($request);
    }
}
