<?php

namespace App;

use App\Template;

class Page404 {

    public function __construct() {
        header("HTTP/1.0 404 Not Found");
        $template = new Template(false);
        //$template->display('404');
    }

}
