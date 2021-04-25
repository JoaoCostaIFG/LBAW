<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Achievement;

class ProfileController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $achievements = Achievement::all();
        return view("pages.profile", ['user' => $user, 'achievements' => $achievements]);
    }
}
