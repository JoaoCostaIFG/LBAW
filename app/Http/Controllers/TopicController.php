<?php

namespace App\Http\Controllers;

use App\Models\TopicProposal;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'topic_name' => 'required|string|min:1|max:20|unique:topic_proposal,topic_name|unique:topic,name',
            'reason' => 'required|string|max:256'
          ]
        );
    }

    public function create($name)
    {
        return Topic::create([
            'name' => $name,
        ]);
    }

    public function suggest(Request $request)
    {
      $data = $request->all();

      $validation = $this->validator($data);
      if ($validation->fails())
        return back()->withErrors($validation)->withInput($data);

      $data['id_user'] = Auth::id();
      TopicProposal::create($data);
      return back();
    }
}
