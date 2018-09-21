<?php

namespace App;

use App\Template;

class NoPrivilage {

    public function __invoke($privilage) {
        $template = new Template(false);
        $template->assign('name', $privilage);
        $template->display('NoPrivilage');
    }

}
