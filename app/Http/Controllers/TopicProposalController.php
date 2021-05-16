<?php

namespace App\Http\Controllers;

use App\Models\TopicProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TopicProposalController extends Controller
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
        $proposal = TopicProposal::find($request->proposal_id);
        $proposal->accepted = $request->accepted;
        $proposal->id_admin = $user->id;
        $proposal->save();

        // Create Topic if proposal was accepted
        if($request->accepted){ 
            $topic_controller = new TopicController();
            $topic_controller->create($proposal->topic_name);        
        }

        return true;
    }

    protected function validator(Request $request){
        $validation = Validator::make($request->all(), [
            'accepted' => 'required|boolean',
        ]);

        return $validation;
    }
}
