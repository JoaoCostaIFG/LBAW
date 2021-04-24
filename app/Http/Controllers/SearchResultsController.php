<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;

use Illuminate\Http\Request;

class SearchResultsController extends Controller
{
    public function search(Request $request){
        // $users =  User::whereRaw('user.search @@ plainto_tsquery(\'english\', ?)', array(strtolower($q)));
    }

    public function show(){
        // TODO: Send users from search
        $users = User::all(); // Replace this
        // TODO: Send questions from search
        /*
         Questions missing: 
          - question number of answers
          - post body (limited number of characters)
          - question tags
          - number of days since post
          - owner pic
        */
        $questions = Question::all(); // Replace this
        return view("pages.search_results", ['users' => $users, 'question' => $questions]);
    }
}
