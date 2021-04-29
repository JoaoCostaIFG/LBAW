<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    /**
     * Creates a new comment.
     *
     * @return boolean The creation of a comment was successful
     */
    public function create(Request $request)
    {
        // TODO Verify if isn't owner of own post
        if(!Auth::check()) {
            return null;
        }

        if (is_null($request->post_id) || is_null($request->value)) {
            return null;
        }

        return DB::insert('INSERT INTO "vote" (id_post, id_user, value) VALUES(?, ?, ?)',
            [$request->post_id, Auth::id(), $request->value]);
    }
}

