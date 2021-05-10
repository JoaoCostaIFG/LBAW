<?php

namespace App\Http\Controllers;

use App\Models\AnswerQuestion;
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
            'topics' => ['array' ,'min:1',
                function($attr, $arr, $fail) {
                    $errs = "";
                    if (is_array($arr)) {
                        foreach ($arr as $topic) {
                            if (!is_string($topic)) {
                                $fail('Invalid topic type (not string)');
                            }
                            else if (Topic::where('name', $topic)->doesntExist()) {
                                $errs .= " " . $topic;
                            }
                        }
                        if ($errs != "")
                            $fail("Invalid topic(s)" . $errs);
                    }
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
        return view("pages.ask_question", ['topics' => Topic::all()->pluck('name')]);
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

    public function close($id, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id_answer' => 'nullable|exists:answer,id',
        ]);

        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());

        $question = Question::find($id);
        $data = $request->all();
        $question->closed = true;
        if (isset($data['id_answer'])) {
            $question->accepted_answer = $data['id_answer'];
        }
        $question->save();


        return redirect()->intended('/question/' . $question->id);
        
    }
}
