<?php

namespace App;

class DB {

    static $database;

    static public function get() {
        if (!self::$database) {
            self::$database = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
        }
        return self::$database;
    }

}
