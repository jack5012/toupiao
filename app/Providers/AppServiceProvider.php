<?php

namespace App\Providers;

use App\Entities\Common\VoteItem;
use App\Entities\Common\VoteProject;
use App\Entities\Common\VoteRecord;
use App\Observers\VoteItemObserver;
use App\Observers\VoteProjectObserver;
use App\Observers\VoteRecordObserver;
use Encore\Admin\Config\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Config::load();
        VoteItem::observe(VoteItemObserver::class);
        VoteRecord::observe(VoteRecordObserver::class);
        VoteProject::observe(VoteProjectObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
