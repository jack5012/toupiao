<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Repositories\VoteProjectRepository::class, \App\Repositories\Eloquent\VoteProjectRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\VoteItemRepository::class, \App\Repositories\Eloquent\VoteItemRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\VoteRecordRepository::class, \App\Repositories\Eloquent\VoteRecordRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\VoteRuleRepository::class, \App\Repositories\Eloquent\VoteRuleRepositoryEloquent::class);
        //:end-bindings:
    }
}
