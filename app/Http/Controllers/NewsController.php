<?php

namespace App\Http\Controllers;

class NewsController extends Controller
{
    public function show()
    {
        return view("pages.news");
    }

}
