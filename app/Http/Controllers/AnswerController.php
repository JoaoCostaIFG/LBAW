<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{

    /**
     * Get a validator for an incoming comment add request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'body' => 'required|string|min:1',
        ]);
    }

    public function create(Request $request)
    {

        $this->authorize('create', Answer::class);

        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return back()->withErrors($validation);
        }

        Answer::createAnswer($request);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validation = Validator::make(['body' => $request->body, 'id' => $request->id], [
            'id' => 'required|exists:answer,id',
            'body' => 'required|string',
        ]);

        $answer = Answer::find($request->id);
        $this->authorize('update', $answer);

        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());

        // Update
        $answer->post->update(['body' => $request->body]);

        return redirect()->intended('/question/' . $answer->question->id);
    }

    public function showedit($id)
    {
        $validation = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:answer,id',
        ]);

        if ($validation->fails())
            return abort(404);

        $answer = Answer::findOrFail($id);
        return view("pages.edit_answer", ['answer' => $answer]);
    }
}
