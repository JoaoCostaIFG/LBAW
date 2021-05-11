<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use App\Models\Topic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchResultsController extends Controller
{
    public function filterUsersAndQuestions($request, $users, $questions)
    {
        $sortBy = $request->input('sortBy');
        if (isset($sortBy)) {
            if ($sortBy == "most_recent")
                $questions->orderBy('date', 'DESC');
            else if ($sortBy == 'oldest')
                $questions->orderBy('date', 'ASC');
            else if ($sortBy == 'best_score')
                $questions->orderBy('score', 'DESC');
            else if ($sortBy == 'worst_score')
                $questions->orderBy('score', 'ASC');
            else if ($sortBy == 'most_points')
                $users->orderBy('reputation', 'DESC');
            else if ($sortBy == 'least_points')
                $users->orderBy('reputation', 'ASC');
        } else if ($request->input('q') != "") {
            $questions->orderBy('rank_question', 'DESC');
            $users->orderBy('rank_user', 'DESC');
        }

        $start_date = $request->input('start_date');
        if (isset($start_date))
            $questions->where('date', '>', $start_date);

        $end_date = $request->input('end_date');
        if (isset($end_date))
            $questions->where('date', '<', $end_date);
    }

    public function search(Request $request)
    {
        //$validatedData = $request->validate([
        //'search' => 'required'
        //]);

        $search_data = $request->input('q');

        // No search data
        if ($search_data == "") {
            $questions = Question::join('post', "question.id", '=', "post.id");
            $users = User::select('*');
        } else { // Search data
            $topic = Topic::where('name', $search_data)->get();
            if (!$topic->isEmpty()) {
                return redirect('/search/tag/' . $search_data);
            }
            $questions = Question::search($search_data);
            $users = User::search($search_data);
        }

        // Validate dates
        $validation = Validator::make($request->all(), [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->all());

        $this->filterUsersAndQuestions($request, $users, $questions);

        return view("pages.search_results", [
            'questions' => $questions->paginate(5)->withQueryString(),
            'users' => $users->paginate(16)->withQueryString(), 'q' => $search_data
        ]);
    }

    public function searchTag($tag)
    {
        if (!Topic::where('name', $tag)->exists())
            return redirect('/search')->withErrors(["tag" => "No such tag " . $tag]);

        $questions = Question::whereHas('topics', function($q) use($tag) {
            $q->where('topic.name', '=', $tag);
        });

        return view("pages.search_results", [
            'questions' => $questions->paginate(5)->withQueryString(), 'q' => $tag,
            'tag' => $tag
        ]);
    }

    public function searchApi(Request $request)
    {
        //$validatedData = $request->validate([
        // TODO
    }
}
