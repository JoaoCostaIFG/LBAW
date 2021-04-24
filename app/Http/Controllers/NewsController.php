<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function show()
    {
        // TODO: News model?
        $news = DB::table('news')->get();

        return view("pages.news", ['news' => $news]);
    }

}
