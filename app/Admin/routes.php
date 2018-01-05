<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UserController::class);
    $router->resource('vote/project', VoteProjectController::class);
    $router->resource('vote/item', VoteItemController::class);
    $router->resource('vote/record', VoteRecordController::class);
    $router->resource('vote/rule', VoteRuleController::class);
});

