<?php

namespace App\Integration\Allegro;

class Auction {

    private $title;

    public function __construct() {
        
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

}

?>