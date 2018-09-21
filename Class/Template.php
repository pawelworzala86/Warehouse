<?php

namespace App;

use App\Lang;

class Template
{

    private $params;
    private $smarty;
    private $indexRender;

    public function __construct($index = true)
    {
        $this->indexRender = $index;
        $this->params = [];

        $this->smarty = new \Smarty();
        $this->smarty->template_dir = SMARTY_TEMPLATE_DIR;
        $this->smarty->compile_dir = SMARTY_COMPILE_DIR;
        $this->smarty->cache_dir = SMARTY_CACHE_DIR;
        $this->smarty->config_dir = SMARTY_CONFIG_DIR;

        /*$this->assign('paginationFile', Lang::getFolder() . '/Pagination.html');
        $this->assign('deleteDialog', Lang::getFolder() . '/DeleteDialog.html');
        $this->assign('productionInfo', Lang::getFolder() . '/Production/ProductionInfo.html');
        $this->assign('productCatalogTree', Lang::getFolder() . '/Product/ProductCatalogTree.html');
        $this->assign('productCatalogTreeSelect', Lang::getFolder() . '/Product/ProductCatalogTreeSelect.html');
        $this->assign('heading', isset($_POST['heading']) ? $_POST['heading'] : true);*/

        $this->assign('currency', User::getCurrency());
    }

    public function assign($param, $value)
    {
        $this->params[$param] = $value;
    }

    public function display($templateName)
    {
        foreach ($this->params as $key => $value) {
            //$this->smarty->assign($key, $value);

        }
        echo json_encode($this->params, JSON_PRETTY_PRINT);
        exit;
        if (!$this->indexRender) {
            if (!isset($_POST['heading'])||($_POST['heading']==='true')) {
                $this->smarty->assign('heading', true);
                $this->smarty->display(Lang::getFolder() . $templateName . '.html');
            } else {
                $html = $this->smarty->fetch(Lang::getFolder() . $templateName . '.html');
                echo json_encode([
                    'fluentLoader' => isset($this->params['fluentLoader']) ? $this->params['fluentLoader'] : false,
                    'html' => $html,
                ]);
            }
            exit;
        }
        $this->smarty->assign('content', $this->smarty->fetch(Lang::getFolder() . $templateName . '.html'));
        if (User::getId()) {
            if (User::getSuperAdmin()) {
                $this->smarty->display(Lang::getFolder() . 'Index/IndexAdmin.html');
            } else {
                if (!isset($_POST['heading'])||($_POST['heading']==='true')) {
                    $this->smarty->assign('heading', true);
                    $this->smarty->display(Lang::getFolder() . 'Index/Index.html');
                } else {
                    $html = $this->smarty->fetch(Lang::getFolder() . $templateName . '.html');
                    echo json_encode([
                        'fluentLoader' => isset($this->params['fluentLoader']) ? $this->params['fluentLoader'] : false,
                        'html' => $html,
                    ]);
                }
            }
        } else {
            $this->smarty->display(Lang::getFolder() . 'Index/IndexFront.html');
        }
    }

    public function fetch($templateName)
    {
        foreach ($this->params as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        return $this->smarty->fetch($templateName . '.html');
    }

}
