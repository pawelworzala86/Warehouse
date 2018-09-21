<?php

namespace App\Integration\Allegro;

interface Field {

    public function __construct($id, $value);

    public function get();
}

?>