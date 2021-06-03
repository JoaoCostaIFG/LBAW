<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function report(Request $request)
    {
        // Check user is authenticated
        if (!Auth::check()) {
            return back()->withErrors([
                'user' => 'You are not logged in'
            ]);
        }
        $user = Auth::user();
        $data = $request->all();

        // Validation
        $validation = Validator::make($data, [
            'post_id' => 'required|integer|exists:post,id',
            'reason' => 'nullable|string|max:100',
        ]);

        if ($validation->fails())
            return back()->withErrors($validation);

        // Check if report is already registered
        if (Report::where('reporter', '=', $user->id)->where('id_post', '=', $data['post_id'])->exists()) {
            return back()->with('fail', 'Failed to report user: User report was already registered.');
        }

        // Authorize report creation
        $post = Post::find($data['post_id']);
        $user_to_report = User::find($post->owner->id);
        $this->authorize('report', $user_to_report);

        Report::create([
            'post_id' => $data['post_id'],
            'user_id' => $user->id,
            'reason' => $data['reason']
        ]);

        return back()->with('status', 'Success: User reported successfully!');
    }

    public function process(Request $request)
    {
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();
        $data = $request->all();

        // Validate
        $validation = Validator::make($data, [
            'accepted' => 'required|boolean',
            'post_id' => 'required|exists:post,id',
            'reporter' => 'required|exists:user,id'
        ]);
        if ($validation->fails())
            return false;

        // Check if report exists
        $report = Report::where('reporter', '=', $data['reporter'])->where('id_post', '=', $data['post_id'])->first();
        if ($report === null)
            return false;

        // Authorize
        $user_to_report = Post::find($data['post_id'])->owner;
        $this->authorize('ban', $user_to_report);

        // Approve Ban
        if ($data['accepted']) {
            // Update report state
            Report::updateReportState("approved", $user, $data);

            // Ban User
            $user_controller = new UserController();
            $user_controller->ban_procedure([
                'admin_id' => $user->id,
                'user_id' => $user_to_report->id,
                'reason' => $report->reason
            ]);
        } else { // Reject Ban
            Report::updateReportState("rejected", $user, $data);
        }

        return true;
    }
}
