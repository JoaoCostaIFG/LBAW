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

        // No search data
        if ($search_data == "") {
            
            $questions = Question::join('post', "question.id", '=', "post.id");
            $users = User::select('*');
        }
        else{ // Search data
            $questions = Question::search($search_data);
            $users = User::search($search_data);
        }

        // Sort by
        if(isset($_GET['sortBy'])){ 
            if($_GET['sortBy']=="most_recent")
                $questions->orderBy('date', 'DESC');
            else if($_GET['sortBy']=='oldest')
                $questions->orderBy('date', 'ASC');
            else if($_GET['sortBy']=='best_score')
                $questions->orderBy('score', 'DESC');
            else if($_GET['sortBy']=='worst_score')
                $questions->orderBy('score', 'ASC');
            else if($_GET['sortBy']=='most_points')
                $users->orderBy('reputation', 'DESC');
            else if($_GET['sortBy']=='least_points')
                $users->orderBy('reputation', 'ASC');
        }
        else if ($search_data != ""){
            $questions->orderBy('rank_question', 'DESC');;
            $users->orderBy('rank_user', 'DESC');
        }

        return view("pages.search_results", ['questions' => $questions->paginate(5)->withQueryString(),
         'users' => $users->paginate(16)->withQueryString(), 'search' => $search_data]);
    }

    public function searchApi(Request $request){
        //$validatedData = $request->validate([
        // TODO
    }
}