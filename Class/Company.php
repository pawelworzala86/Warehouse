<?php

namespace App;

class Company {

    static private $companyId;

    static public function getId() {
        if (!self::$companyId) {
            self::$companyId = isset($_SESSION['companyId']) ? $_SESSION['companyId'] : null;
        }
        return self::$companyId;
    }

    static public function setId($id) {
        self::$companyId = $id;
        $_SESSION['companyId'] = $id;
    }

}
