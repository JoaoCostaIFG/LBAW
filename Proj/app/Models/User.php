<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps = false;

    protected $table = "user";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'search', 'picture'
    ];

    protected $fillable = [
        'name', 'username', 'password', 'email', 'picture'
    ];

    public static function banUser($data)
    {
        DB::select(
            "CALL ban_user(?, ?, ?)",
            [$data['user_id'], $data['admin_id'], $data['reason']]
        );
    }

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0];
    }

    public function getLastNameAttribute()
    {
        $split = explode(' ', $this->name, 2);
        if (count($split) == 1)
            return "";
        return $split[1];
    }

    public function getPfp()
    {
        if (is_null($this->picture))
            return "default.jpg";
        return $this->picture;
    }

    // Relations
    public function posts()
    {
        return $this->hasMany(Post::class, 'id_owner', 'id');
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Post::class, 'id_owner', 'id', 'id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Post::class, 'id_owner', 'id', 'id', 'id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class, 'id_owner', 'id', 'id', 'id');
    }

    public function achievements()
    {
        return $this->hasManyThrough(
            Achievement::class,
            Achieved::class,
            'id_user',
            'id',
            'id',
            'id_achievement'
        );
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'recipient', 'id');
    }

    // Search functions

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        $search = "'" . $search . "'";
        return $query->selectRaw('*, ts_rank(search, plainto_tsquery(?)) as rank_user', [$search])->whereRaw('search @@ plainto_tsquery(?)', [$search]);
    }

    public function hasRole($role)
    {
        if (DB::table('administrator')->where('id', $this->id)->exists() && ($role === 'administrator' || $role === 'moderator')) {
            return true;
        }
        if (DB::table('moderator')->where('id', $this->id)->exists() && $role === 'moderator') {
            return true;
        }
        return false;
    }

    public function getVote($post)
    {
        $vote = Vote::join('user', 'user.id', '=', 'vote.id_user')
            ->join('post', 'vote.id_post', '=', 'post.id')
            ->where('user.id', '=', $this->id)
            ->where('post.id', '=', $post->id);
        if ($vote->exists())
            return $vote->get()[0];
        return false;
    }

    public function getQuestionParticipation()
    {
        $questions_topic = Topic::selectRaw('topic.name as topic_name, post.id as post_id, post.score as score')
            ->join('topic_question', 'topic.id', '=', 'topic_question.id_topic')
            ->join('question', 'question.id', '=', 'topic_question.id_question')
            ->join('post', 'post.id', '=', 'question.id')
            ->join('user', 'user.id', '=', 'post.id_owner')
            ->where('user.id', '=', $this->id);
        return DB::table(DB::raw("({$questions_topic->toSql()}) as sub"))->mergeBindings($questions_topic->getQuery())
            ->selectRaw('topic_name, count(post_id) as cnt, sum(score) as score')
            ->groupBy('topic_name')
            ->orderBy('cnt', 'desc');
    }

    public function getAnswerParticipation()
    {
        $answer_topic = Topic::selectRaw('topic.name as topic_name, post.id as post_id, post.score as score')
            ->join('topic_question', 'topic.id', '=', 'topic_question.id_topic')
            ->join('question', 'question.id', '=', 'topic_question.id_question')
            ->join('answer_question', 'question.id', '=', 'answer_question.id_question')
            ->join('answer', 'answer.id', '=', 'answer_question.id_answer')
            ->join('post', 'post.id', '=', 'answer.id')
            ->join('user', 'user.id', '=', 'post.id_owner')
            ->where('user.id', '=', $this->id);

        return DB::table(DB::raw("({$answer_topic->toSql()}) as sub"))->mergeBindings($answer_topic->getQuery())
            ->selectRaw('topic_name, count(post_id) as cnt, sum(score) as score')
            ->groupBy('topic_name')
            ->orderBy('cnt', 'desc');
    }

    public function getTopicParticipation()
    {
        $answers = $this->getAnswerParticipation();
        $questions = $this->getQuestionParticipation();

        $subq = $answers;
        $subq->unionAll($questions);

        return DB::table(DB::raw("({$subq->toSql()}) as sub"))->mergeBindings($subq)
            ->selectRaw('topic_name, sum(cnt) as cnt, sum(score) as score')
            ->groupBy('topic_name')
            ->orderBy('cnt', 'desc');
    }

    public static function getTopUsers()
    {
        $users = User::orderBy('reputation', 'desc')
            ->select('id', 'username', 'reputation')
            ->where('isdeleted', '!=', 'true')
            ->limit(9)
            ->get();
        return $users;
    }
}
