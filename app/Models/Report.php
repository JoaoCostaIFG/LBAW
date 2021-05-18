<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    use HasFactory;

    protected $table = "report";
    public $timestamps = false;

    protected $fillable = [
        'reporter', 'id_post', 'reason'
    ];

    public function reporter()
    {
        return $this->hasOne(User::class, 'id', 'reporter');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'id_post');
    }

    public function scopePending($query) {
        return $query->where('state', 'pending');
    }

    public static function create($data) {                    
        return DB::table('report')->insert(
            array(
                'id_post' => $data['post_id'], 
                'reporter' => $data['user_id'], 
            )
       );
    }
}

