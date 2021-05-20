<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function getTopUsers()
    {
        $users = User::orderBy('reputation', 'desc')
            ->select('id', 'username', 'reputation')
            ->where('isdeleted', '!=', 'true')
            ->limit(50)
            ->get();
        return $users;
    }

    public function getTopQuestions()
    {
        $questions = DB::table('post')
            ->join('question', 'post.id', '=', 'question.id')
            ->orderBy('score', 'desc')
            ->limit(20)
            ->get();
        return $questions;
    }

    public function show(){
        $users = $this->getTopUsers();
        $questions = $this->getTopQuestions();
        return view("pages.leaderboard", ['users' => $users, 'questions' => $questions]);
    }
}
