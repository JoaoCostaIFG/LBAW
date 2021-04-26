<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdministrationController extends Controller
{
    public function show(){
        echo('<br>');
        $posts = Post::with('question')->with('answer')->with('comment')->get();
        foreach ($posts as $post) {
            echo($post);
            echo('<br>');
        }
        return view("pages.administration");
    }
}

