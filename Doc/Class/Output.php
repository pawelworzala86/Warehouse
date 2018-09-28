<?php

class Output
{

    private $handlerName;
    private $url;
    private $requestName;
    private $requestData;
    private $responseName;
    private $responseData;
    private $smarty;
    private $documentation;

    public function __construct()
    {
        $this->smarty = new Smarty;
        $this->smarty->template_dir = 'Doc/Cache/views/';
        $this->smarty->compile_dir = 'Doc/Cache/lib/smarty/templates_c/';
        $this->smarty->cache_dir = 'Doc/Cache/lib/smarty/cache/';
        $this->smarty->config_dir = 'Doc/Cache/lib/smarty/configs/';
    }

    function add($method, $handlerName, $url, $requestData, $responseData){
        $this->documentation[] = [
            'method' => $method,
            'handlerName' => $handlerName,
            'url' => $url,
            'requestData' => json_encode($requestData, JSON_PRETTY_PRINT),
            'responseData' => json_encode($responseData, JSON_PRETTY_PRINT),
        ];
    }

    function out()
    {
        $this->smarty->assign('documentation', $this->documentation);
        $this->smarty->display('Doc/Index.html');
    }

}