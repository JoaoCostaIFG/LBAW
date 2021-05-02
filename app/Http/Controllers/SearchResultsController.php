<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;

use Illuminate\Http\Request;

class SearchResultsController extends Controller
{
    public function search(Request $request){
        //$validatedData = $request->validate([
            //'search' => 'required'
        //]);

        $search_data = $request->input('search');
        if ($search_data == "") {
            return view("pages.search_results", ['questions' => Question::all(),
             'users' => User::all()]);
        }

        $questions = Question::search($search_data)->get();
        $users = User::search($search_data)->get();

        return view("pages.search_results", ['questions' => $questions,
         'users' => $users, 'search' => $search_data]);
    }

    public function searchApi(Request $request){
        //$validatedData = $request->validate([
        // TODO
    }
}