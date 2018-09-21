<?php

namespace App;

class User
{

    static private $userId;
    static private $userSuperAdmin;
    static private $currency;

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

    static public function getSuperAdmin()
    {
        if (self::$userSuperAdmin === null) {
            self::$userSuperAdmin = isset($_SESSION['userSuperAdmin']) ? $_SESSION['userSuperAdmin'] : 0;
        }
        return self::$userSuperAdmin;
    }

    static public function setSuperAdmin($val)
    {
        self::$userSuperAdmin = $val;
        $_SESSION['userSuperAdmin'] = $val;
    }

    static public function getCurrency()
    {
        if (!self::$currency) {
            self::$currency = isset($_SESSION['userCurrency']) ? $_SESSION['userCurrency'] : null;
        }
        return self::$currency;
    }

    static public function setCurrency($currency)
    {
        self::$currency = $currency;
        $_SESSION['userCurrency'] = $currency;
    }

}
