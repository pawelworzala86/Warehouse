<?php

namespace App;

class Template
{

    private $params;
    private $smarty;
    private $indexRender;

    public function __construct($index = true)
    {
        $this->indexRender = $index;
        $this->params = [];

        $this->smarty = new \Smarty;
        $this->smarty->template_dir = SMARTY_TEMPLATE_DIR;
        $this->smarty->compile_dir = SMARTY_COMPILE_DIR;
        $this->smarty->cache_dir = SMARTY_CACHE_DIR;
        $this->smarty->config_dir = SMARTY_CONFIG_DIR;
    }

    public function assign($param, $value)
    {
        $this->params[$param] = $value;
    }

    public function fetch($templateName)
    {
        foreach ($this->params as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        return $this->smarty->fetch($templateName . '.html');
    }

}
