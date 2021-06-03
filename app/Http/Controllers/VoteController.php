<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if (!Auth::check()) {
            return null;
        }

        if (
            is_null($request->post_id) || is_null($request->value)
            || Post::find($request->post_id)->owner->id == Auth::id()
        ) {
            return null;
        }

        $vote = Auth::user()->getVote(Post::find($request->post_id));
        if ($vote == false) {
            return Vote::create($request);
        } else {
            $vote->update(["value" => $request->value]);
            $vote->save();
            return $vote;
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
        if (!Auth::check()) {
            return null;
        }

        if (is_null($request->post_id)) {
            return null;
        }

        return Vote::deleteVote($request);
    }
}
