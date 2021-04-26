<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdministrationController extends Controller
{
    public function show(){
        echo('<br>');
        $posts = Post::all();
        foreach ($posts as $post) {
            echo($post->child);
            echo('<br>');
        }
        return view("pages.administration");
    }
}

