<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function show()
    {
        $news = News::getAllNews();
        return view("pages.news", ['news' => $news]);
    }
}
