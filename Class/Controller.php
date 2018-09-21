<?php

namespace App;

use App\Template;
use App\Privilage;
use App\User;

class Controller {

    private $template;

    public function __construct() {
        $this->template = new Template(isset($_POST['ajax'])?$_POST['ajax']==='false':true);
        $this->assign('description', '');
        $this->assign('keywords', '');
        $this->assign('currency', 'PLN');

        if (USer::getId()) {
            $this->assign('productsPrivilage', $this->checkPrivilage('product-list'));
            $this->assign('werhousePrivilage', $this->checkPrivilage('werhouse-list'));
            $this->assign('contractorPrivilage', $this->checkPrivilage('contractor-list'));
            $this->assign('documentPrivilage', $this->checkPrivilage('document-list'));
            $this->assign('productionPrivilage', $this->checkPrivilage('production-list'));
            $this->assign('workerPrivilage', $this->checkPrivilage('worker-list'));
        }
    }

    public function assign($param, $value) {
        $this->template->assign($param, $value);
    }

    public function display($templateName) {
        global $r;
        $r['template'] = '/Public/Template/'.Lang::getFolder().$templateName;
        $this->template->display($templateName);
    }

    public function fetch($templateName) {
        return $this->template->fetch($templateName);
    }

    public function checkPrivilage($privilage) {
        return Privilage::check($privilage);
    }

    public function header($url)
    {
        $url = str_replace('Location: ', '', $url);
        echo json_encode(['redirect'=>$url]);
        exit;
    }

}
