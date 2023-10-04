<?php

namespace Aghabalaguluzade\app\Http\Controllers;

class UserController 
{
    public function show($id1, $id2) {
        return "user_id " . $id1 . '---->' . $id2;
    }
}