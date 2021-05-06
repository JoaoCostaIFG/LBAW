<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|min: 5|max:255|unique:question,title',
            'body' => 'string|max:4095',
            'bounty' => 'required|integer|between:0,100',
            'topics' => ['string',
                function($attr, $str, $fail) {
                    $arr = explode(" ", $str);
                    $errs = "";
                    foreach ($arr as $topic) {
                    if (Topic::where('name', $topic)->doesntExist())
                        $errs .= " " . $topic;
                    }
                    if ($errs != "")
                        $fail("Invalid topic(s)" . $errs);
                }]
        ]);
    }

    public function show($id)
    {
        $question = Question::find($id);
        return view("pages.question_page", ['question' => $question]);
    }

    public function create()
    {
        return view("pages.ask_question");
    }

    public function store(Request $request)
    {
        $validation = $this->validator($request->all());
        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());
        $data = $request->all();
        $data['owner'] = Auth::id();
        $question = Question::create($data);
        return redirect()->intended('/question/' . $question->id);
    }
}
