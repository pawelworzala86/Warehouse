<?php

namespace App\Modules\Other\Controller;

use App\Controller;
use App\LoremIpsum;

class Page extends Controller
{

    public function __invoke($id)
    {
        $loremIpsum = new LoremIpsum;
        $content = '';
        for ($i = 0; $i < 5; $i++) {
            $content .= '<p>' . $loremIpsum->sentences(rand(5, 10)) . '</p>';
        }
        $this->assign('content', $content);
        $this->display('Other/Page');
    }

}