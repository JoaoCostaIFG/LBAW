<?php

namespace App\Providers;

use App\Policies\QuestionPolicy;
use App\Policies\CommentPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\AnswerPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Question::class => QuestionPolicy::class,
        Comment::class => CommentPolicy::class,
        Notification::class => NotificationPolicy::class,
        Answer::class => AnswerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
