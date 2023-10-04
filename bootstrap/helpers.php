<?php

use \Aghabalaguluzade\bootstrap\Route;

    function route(string $name, array $params = []) {
        return Route::url($name, $params);
    }