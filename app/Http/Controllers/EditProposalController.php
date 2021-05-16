<?php

namespace App\Http\Controllers;

use App\Models\EditProposal;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EditProposalController extends Controller
{
    public function update(Request $request)
    {
        // Validate request
        $validation = $this->validator($request);
        if ($validation->fails())
            return false; 

        // Authorize user
        $user = Auth::user();
        $this->authorize('update', $user);

        // Update proposal
        $proposal = EditProposal::find($request->proposal_id);
        $proposal->accepted = $request->accepted;
        $proposal->id_moderator = $user->id;
        $proposal->save();

        // Update Post if proposal was accepted
        if($request->accepted){ 
            $post = Post::find($proposal->id_post);
            $post->body = $proposal->body;
            $post->save();
        }

        return true;
    }

    protected function validator(Request $request){
        $validation = Validator::make($request->all(), [
            'accepted' => 'required|boolean',
            'proposal_id' => 'exists:edit_proposal,id'
        ]);

        return $validation;
    }
}
