<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function getTopUsers()
    {
        $users = User::orderBy('reputation', 'desc')->limit(50)->get();
        return $users;
    }

    public function show(){
        $users = $this->getTopUsers();
        return view("pages.leaderboard", ['users' => $users]);
    }
}
