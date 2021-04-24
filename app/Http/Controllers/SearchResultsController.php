<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class SearchResultsController extends Controller
{
    public function search(Request $request){
        // $users =  User::whereRaw('user.search @@ plainto_tsquery(\'english\', ?)', array(strtolower($q)));
    }

    public function show(){
        // TODO: Send users and posts from search
        $users = User::all();
        return view("pages.search_results", ['users' => $users]);
    }
}
