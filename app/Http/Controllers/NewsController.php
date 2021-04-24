<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function show()
    {
        $news = DB::table('news')
            ->select('title', 'subtitle', 'body')
            ->get();

        return view("pages.news", ['news' => $news]);
    }

}
