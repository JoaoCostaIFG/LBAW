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

    public function reviewer()
    {
        return $this->hasOne(User::class, 'id', 'reviewer');
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

    public static function updateReportState($new_state, $user, $data) {
        DB::update('update report
                      set state = ?, reviewer = ?
                      where reporter = ? and id_post = ?',
                      [$new_state, $user->id, $data['reporter'], $data['post_id']]);
    }
}

