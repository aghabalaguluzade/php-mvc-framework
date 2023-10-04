<?php

namespace Aghabalaguluzade\app\Http\Controllers;

class UserController 
{
    public function show($id) {
        return "user_id " . $id;
    }
}