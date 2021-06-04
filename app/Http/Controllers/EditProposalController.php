<?php

namespace App\Http\Controllers;

use App\Models\EditProposal;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EditProposalController extends Controller
{
    protected function validator(Request $request){
        $validation = Validator::make($request->all(), [
            'accepted' => 'required|boolean',
            'proposal_id' => 'exists:edit_proposal,id'
        ]);

        return $validation;
    }

    public function show($id)
    {
        $validation = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:post,id',
        ]);
        if ($validation->fails())
            return abort(404);

        $post = Post::findOrFail($id);
        if ($post->type != "question" && $post->type != "answer")
            return abort(404);

        return view("pages.edit_proposal", ['post' => $post]);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id_post' => 'required|integer|exists:post,id',
            'body' => 'required|string|max:4095',
        ]);

        if ($validation->fails()) {
            return null;
        }

        $post = Post::findOrFail($request->id_post);
        $question_id = $post->parentQuestion()->get()[0]->id;

        EditProposal::create([
            'id_post' => $request->id_post,
            'body' => $request->body,
            'id_user' => Auth::id()
        ]);

        return redirect()->intended('/question/' . $question_id);
    }

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
}
