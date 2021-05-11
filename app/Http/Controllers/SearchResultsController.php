<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use App\Models\Topic;

use Illuminate\Http\Request;

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
            else if ($sortBy = ' best_score')
                $questions->orderBy('score', 'DESC');
            else if ($sortBy == 'worst_score')
                $questions->orderBy('score', 'ASC');
            else if ($sortBy == 'most_points')
                $users->orderBy('reputation', 'DESC');
            else if ($sortBy == 'least_points')
                $users->orderBy('reputation', 'ASC');
        } else if ($request->input('search') != "") {
            $questions->orderBy('rank_question', 'DESC');
            $users->orderBy('rank_user', 'DESC');
        }

        $start_date = $request->input('start_date');
        if (isset($start_date))
            $questions->where('date', '>', $_GET['start_date']);

        $end_date = $request->input('start_date');
        if (isset($end_date))
            $questions->where('date', '<', $_GET['end_date']);
    }

    public function search(Request $request)
    {
        //$validatedData = $request->validate([
        //'search' => 'required'
        //]);

        $search_data = $request->input('search');

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

        $this->filterUsersAndQuestions($request, $users, $questions);
        //Date TODO
        // $request->validate([
        //     'start_date' => 'nullable|date',
        //     'end_date' => 'nullable|date',
        // ]); // tou triste :( @nachos
        // if (isset($_GET['start_date']) && $_GET['start_date'] != "") {
        //     $questions->where('date', '>', $_GET['start_date']);
        // }
        // if (isset($_GET['end_date']) && $_GET['end_date'] != "") {
        //     $questions->where('date', '<', $_GET['end_date']);
        // }

        return view("pages.search_results", [
            'questions' => $questions->paginate(5)->withQueryString(),
            'users' => $users->paginate(16)->withQueryString(), 'search' => $search_data
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
            'questions' => $questions->paginate(5)->withQueryString(), 'search' => $tag,
            'tag' => $tag
        ]);
    }

    public function searchApi(Request $request)
    {
        //$validatedData = $request->validate([
        // TODO
    }
}
