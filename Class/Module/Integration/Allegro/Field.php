<?php

namespace App\Module\Integration\Allegro;

interface Field {

    public function __construct($id, $value);

    public function get();
}

?>