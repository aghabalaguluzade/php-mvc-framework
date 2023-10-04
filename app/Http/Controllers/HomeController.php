<?php

namespace Aghabalaguluzade\app\Http\Controllers;

class HomeController 
{
    public function index() {
        return route('user', [':id' => 1]);
    }
}