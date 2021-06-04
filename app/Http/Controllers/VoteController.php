<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    /**
     * Creates a new vote.
     *
     * @return boolean The creation of a vote was successful TODO
     */
    public function create(Request $request)
    {
        // TODO Verify if isn't owner of own post
        $validation = Validator::make($request->all(), [
            'post_id' => 'required|integer',
            'value' => 'required|integer|in:-1,1',
        ]);

        if ($validation->fails())
            return $validation->errors();

        if (Post::find($request->post_id)->owner->id == Auth::id()) {
            return "Fail: Cannot vote on own post";
        }

        $vote = Auth::user()->getVote(Post::find($request->post_id));
        if ($vote == false) {
            return Vote::create($request);
        } else {
            $vote->updateVote($request);
            return "Success";
            // return DB::update('UPDATE "vote" SET value=? WHERE id_post=? AND id_user=?',
            //     [$request->value, $request->post_id, Auth::id()]);
        }
    }

    /**
     * Deletes a vote.
     *
     * @return boolean The deletion of a vote was successful TODO
     */
    public function delete(Request $request)
    { 
        $validation = Validator::make($request->all(), [
            'post_id' => 'required|integer',
        ]);

        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());

        return Vote::deleteVote($request);
    }
}
