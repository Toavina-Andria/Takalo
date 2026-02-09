<?php

namespace app\service;

use flight\Engine;

class AdminService {

    protected Engine $app;



    public function getexchages() {
        $exechanges = [
            [ 'id' => 1, 'object1' => 1,'object2' => 10, 'user1' => 1, 'user2' => 2, 'status' => 'pending' ],
            [ 'id' => 2, 'object1' => 2,'object2' => 20, 'user1' => 1, 'user2' => 3, 'status' => 'pending' ],
            [ 'id' => 3, 'object1' => 3,'object2' => 30, 'user1' => 2, 'user2' => 3, 'status' => 'pending' ],

        ];
        return $exechanges;
    }
}