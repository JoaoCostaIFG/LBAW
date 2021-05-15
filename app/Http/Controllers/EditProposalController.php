<?php

namespace App\Http\Controllers;

use App\Models\EditProposal;
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

        $proposal = EditProposal::find($request->proposal_id);
        $user = Auth::user();
        $this->authorize('update', $user);

        $proposal->accepted = $request->accepted;
        $proposal->id_moderator = $user->id;
        $proposal->save();

        return true;
    }

    protected function validator(Request $request){
        $validation = Validator::make($request->all(), [
            'accepted' => 'required|boolean',
        ]);

        return $validation;
    }
}
