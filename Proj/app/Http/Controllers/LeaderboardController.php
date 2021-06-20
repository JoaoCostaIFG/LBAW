<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;

class LeaderboardController extends Controller
{

    public function show()
    {
        $users = User::getTopUsers();
        $questions = Question::getTopQuestions();
        return view("pages.leaderboard", ['users' => $users, 'questions' => $questions]);
    }
}
