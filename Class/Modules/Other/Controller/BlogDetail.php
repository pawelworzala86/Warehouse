<?php

namespace App\Modules\Other\Controller;

use App\Controller;
use App\LoremIpsum;

class BlogDetail extends Controller
{

    public function __invoke()
    {
        $loremIpsum = new LoremIpsum;
        $description = '';
        for ($i = 0; $i < rand(3, 6); $i++) {
            $buf = '';
            for ($x = 0; $x < rand(5, 10); $x++) {
                $buf .= $loremIpsum->sentence();
            }
            $description .= '<p>' . $buf . '</p>';
        }
        $article = [
            'title' => $loremIpsum->wordsR(rand(1, 4)),
            'date' => '26-01-2018',
            'description' => $description,
        ];
        $this->assign('article', $article);
        $this->display('Other/BlogDetail');
    }

}