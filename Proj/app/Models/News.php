<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = "news";
    public $timestamps = false;

    public static function getAllNews()
    {
        return DB::table('news')
            ->select('title', 'subtitle', 'body')
            ->get();
    }
}
