<?php


namespace App\Providers;

use App\Task;
use App\Tag;
use App\User;
use App\TaskStatus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['task.index', 'task.create', 'task.edit'], function ($view) {
            $taskStatuses = TaskStatus::pluck('name', 'id');
            $users = User::pluck('name', 'id');
            $tags = Tag::pluck('name', 'id');
            $view->with(compact('users', 'taskStatuses', 'tags'));
        });
    }
}
