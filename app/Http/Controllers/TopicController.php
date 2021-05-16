<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function create($name)
    {
        return Topic::create([
            'name' => $name,
        ]);
    }
}
