<?php

use Illuminate\Routing\RouteRegistrar;

/** @var RouteRegistrar $router */

$router->get('/', function () {
    return view('welcome');
});

$router->get('/articles/{articleId}', 'ArticleController@index');
