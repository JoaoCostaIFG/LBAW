<?php

namespace App\Http\Controllers;

use App\Models\AnswerQuestion;
use App\Models\Question;
use App\Models\Topic;
use App\Models\TopicQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|min:5|max:255|unique:question,title',
            'body' => 'string|max:4095',
            'bounty' => ['required', 'integer', 'min:0', 'max:500',
                function($attr, $bounty, $fail) {
                    $rep = Auth::user()->reputation;
                    if ($bounty > $rep)
                        $fail('Bounty cannot excede your reputation (' . $rep . ')');
                }
            ],
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
                }
            ]
        ]);
    }

    public function show($id, $title)
    {
        $validation = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:question,id',
        ]);
        if ($validation->fails())
            return abort(404);

        $question = Question::findOrFail($id);
        $actual_title = str_replace(' ', '-', $question->title);
        $actual_title = preg_replace( "/[^A-Za-z0-9\-]/", '', $actual_title);
        if ($title != $actual_title)
            return redirect()->route('question', ['id' => $id, 'title' => $actual_title]);

        return view("pages.question_page", ['question' => $question]);
    }

    public function showWithId($id) {
        $validation = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:question,id',
        ]);
        if ($validation->fails())
            return abort(404);

        $question = Question::findOrFail($id);
        $actual_title = str_replace(' ', '-', $question->title);
        $actual_title = preg_replace( "/[^A-Za-z0-9\-]/", '', $actual_title);
        return redirect()->route('question', ['id' => $id, 'title' => $actual_title]);
    }

    public function showedit($id)
    {
        $validation = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:question,id',
        ]);

        if ($validation->fails())
            return abort(404);

        $question = Question::findOrFail($id);
        return view("pages.edit_question", ['question' => $question,
            'topics' => Topic::all()->pluck('name'),
            'selected_topics' => $question->topics->pluck('name')->toArray()]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $data['owner'] = Auth::id();

        $question = Question::find($request->id);
        $this->authorize("update", $question);
        $max_budget = min(Auth::user()->reputation, 500);

        $validation = Validator::make($data, [
            'title' => 'required|string|min:5|max:255|unique:question,title,' . $question["id"],
            'body' => 'string|max:4095',
            'bounty' => ['integer', 'nullable', 'min:0', 'max:' . $max_budget,
                function($attr, $bounty, $fail) use($question) {
                    if ($question->bounty != 0)
                        $fail('Cannot assign bounty to a question which already has a bounty');
                }
            ],
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
            ]
        );

        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());

        DB::transaction(function () use ($question, $data) {
            if (isset($data["bounty"]))
                Auth::user()->reputation = Auth::user()->reputation - $data["bounty"];
            Auth::user()->save();
            $question->update($data);
            $question->post->update(["body" => $data["body"]]);

            TopicQuestion::where('id_question', $question->id)->delete();
            foreach($data["topics"] as $topic_name) {
                $topic = Topic::where('name', $topic_name)->get()[0];
                TopicQuestion::create(['id_question' => $question->id, 'id_topic' => $topic->id]);
            }
        });
        return redirect()->intended('/question/' . $question->id);
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

    public function delete($id) {
        $validation = Validator::make(['id' => $id], [
            'id' => 'required|exists:question,id',
        ]);

        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());

        $question = Question::findOrFail($id);

        $this->authorize('delete', $question);
        $question->delete();

        return redirect()->intended('/search/');
    }

    public function addBounty($id, Request $request) {
        $bounty = $request->input('bounty');
        $validation = Validator::make(['id' => $id, 'bounty' => $bounty], [
            'id' => 'required|exists:question,id',
            'bounty' => 'required|integer|min:0|max:500'
        ]);

        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());
        $question = Question::find($id);
        if ($question->closed)
            return back()->withErrors(['id' => 'Cannot assign bounty to a question which is closed!'])
                ->withInput($request->input());
        if ($question->bounty != 0)
            return back()->withErrors(['bounty' => 'Cannot assign bounty to a question which already has a bounty'])
                ->withInput($request->input());
        if ($bounty > Auth::user()->reputation)
            return back()->withErrors(['bounty' => 'Your defined bounty cannot excede your reputation'])
                ->withInput($request->input());

        $question->bounty = $bounty;
        Auth::user()->reputation = Auth::user()->reputation - $bounty;
        Auth::user()->save();
        $question->save();
        return redirect()->intended('/question/' . $id);
    }
}
