<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // TODO: add
        Gate::define('update-question', function ($user, $question) {
            return $user->id === $question->user_id;
            // echo "$user->id , user id: " .  $question->user_id . " condicion: " .  ($user->id === $question->user_id);
            // dd();
        });

        Gate::define('delete-question', function ($user, $question) {
            return $user->id === $question->user_id;
        });        
    }
}
