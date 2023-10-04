<?php

require __DIR__ . '/vendor/autoload.php';

use Aghabalaguluzade\bootstrap\{ App, Route };
use Dotenv\Dotenv;

$app = new App;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

Route::get('/', function() {
    return 'home page';
})->name('home');

Route::get('/users', function() {
    return 'users page';
});

Route::get('/user/:id', 'UserController@show')->name('user');

Route::get('/controller', 'HomeController@index');

Route::post('/users', function() {
    return 'users post';
});

Route::dispatch();