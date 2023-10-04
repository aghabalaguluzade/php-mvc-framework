<?php

require __DIR__ . '/vendor/autoload.php';

use Aghabalaguluzade\bootstrap\{ App, Route };
use Dotenv\Dotenv;

$app = new App;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

function route(string $name, array $params = []) {
    return Route::url($name, $params);
}

Route::get('/', function() {
    return 'home page';
})->name('home');

Route::get('/users', function() {
    return 'users page';
});

Route::get('/user/:id1/:id2', 'UserController@show')->name('user');
echo route('user', [':id1' => 1, ':id2' => 2]);

Route::get('/controller', 'HomeController@index');

Route::post('/users', function() {
    return 'users post';
});

Route::dispatch();