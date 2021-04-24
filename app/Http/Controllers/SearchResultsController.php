<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchResultsController extends Controller
{
    public function search(Request $request){
        // $users =  User::whereRaw('user.search @@ plainto_tsquery(\'english\', ?)', array(strtolower($q)));
    }

    public function show(){
        // TODO: Send users and posts
        return view("pages.search_results");
    }
}
