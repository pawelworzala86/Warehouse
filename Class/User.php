<?php

namespace App;

class User
{

    static private $userId;

    static public function getId()
    {
        if (!self::$userId) {
            self::$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        }
        return self::$userId;
    }

    static public function setId($id)
    {
        self::$userId = $id;
        $_SESSION['userId'] = $id;
    }

}
