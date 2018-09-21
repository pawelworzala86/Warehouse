<?php

namespace App;

class Werhouse {

    static private $werhouseId;

    static public function getId() {
        if (!self::$werhouseId) {
            self::$werhouseId = isset($_SESSION['werhouseId']) ? $_SESSION['werhouseId'] : null;
        }
        return self::$werhouseId;
    }

    static public function setId($id) {
        self::$werhouseId = $id;
        $_SESSION['werhouseId'] = $id;
    }

}
