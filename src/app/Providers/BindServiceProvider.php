<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(
            'App\Contracts\UserRepositoryInterface',
            'App\Repositories\UserRepository'
            );
        
        App::bind(
            'App\Contracts\TaskRepositoryInterface',
            'App\Repositories\TaskRepository'
            );
        
        App::bind(
            'App\Contracts\AssignmentRepositoryInterface',
            'App\Repositories\AssignmentRepository'
            );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
