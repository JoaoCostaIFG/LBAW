<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;

use Illuminate\Http\Request;

class SearchResultsController extends Controller
{
    public function search(Request $request){
        $validatedData = $request->validate([
            'search' => 'required'
        ]);

        $questions = Question::search($validatedData['search'])->get();
        $users = User::search($validatedData['search'])->get();

        return view("pages.search_results", ['questions' => $questions, 'users' => $users]);
    }

    public function show(Request $request) {
        // TODO: Send users and posts from search
        $users = User::all();
        return view("pages.search_results", ['users' => $users]);
    }
}
