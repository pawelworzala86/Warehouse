<?php

namespace App;

use Smarty;

class Output
{
    private $smarty;
    private $todos;

    public function __construct()
    {
        $this->smarty = new Smarty;
        $this->smarty->template_dir = 'DocHandler/Cache/views/';
        $this->smarty->compile_dir = 'DocHandler/Cache/lib/smarty/templates_c/';
        $this->smarty->cache_dir = 'DocHandler/Cache/lib/smarty/cache/';
        $this->smarty->config_dir = 'DocHandler/Cache/lib/smarty/configs/';
    }

    function add($id, $name, $description, $done){
        $this->todos[] = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'done' => $done,
        ];
    }

    function out()
    {
        $this->smarty->assign('todos', $this->todos);
        $this->smarty->display('Root/Index.html');
    }
}