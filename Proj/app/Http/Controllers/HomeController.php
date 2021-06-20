<?php

namespace App\Http\Controllers;

use App\Models\Question;

class HomeController extends Controller
{
    public function show()
    {
        $question = Question::topQuestion()[0];
        return view("pages.index", ['question' => $question]);
    }
}
