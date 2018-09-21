<?php

namespace App\Modules\Other\Controller;

use App\Controller;
use App\LoremIpsum;

class Blog extends Controller
{

    public function __invoke()
    {
        $loremIpsum = new LoremIpsum;
        $articles = [];
        for ($i = 0; $i < 10; $i++) {
            $description = '';
            for ($x = 0; $x < 5; $x++) {
                $description .= $loremIpsum->sentence();
            }
            $articles[] = [
                'title' => $loremIpsum->wordsR(rand(1, 4)),
                'date' => '26-01-2018',
                'description' => $description,
            ];
        }
        $this->assign('articles', $articles);
        $this->display('Other/Blog');
    }

}