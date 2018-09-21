<?php

namespace App\Modules\Other\Model;

use App\Model;

class SetupModel extends Model {

    private $privilages;
    private $groups;
    private $groupsPrivilages;

    public function __construct() {
        parent::__construct();

        $this->setPrivilages();
        $this->setGroups();
        $this->setGroupsPrivilages();

        $this->install();
    }

    private function setPrivilages() {
        $this->privilages[] = ['tag'=>'product', 'key'=>'product-list', 'description'=>'Dostęp do listy produktów'];
        $this->privilages[] = ['tag'=>'product', 'key'=>'product-del', 'description'=>'Możliwość usuwania produktów'];
        $this->privilages[] = ['tag'=>'product', 'key'=>'product-edit', 'description'=>'Możliwość edycji produktu'];
        
        $this->privilages[] = ['tag'=>'werhouse', 'key'=>'werhouse-add', 'description'=>'Przyjmowanie produktów'];
        $this->privilages[] = ['tag'=>'werhouse', 'key'=>'werhouse-dec', 'description'=>'Wydawanie produktów'];
        $this->privilages[] = ['tag'=>'werhouse', 'key'=>'werhouse-list', 'description'=>'Lista produktów'];
        
        $this->privilages[] = ['tag'=>'contractor', 'key'=>'contractor-list', 'description'=>'Dostęp do listy kontrahentów'];
        $this->privilages[] = ['tag'=>'contractor', 'key'=>'contractor-del', 'description'=>'Możliwość usuwania kontrahentów'];
        $this->privilages[] = ['tag'=>'contractor', 'key'=>'contractor-edit', 'description'=>'Możliwość edycji kontrahentów'];
        
        $this->privilages[] = ['tag'=>'document', 'key'=>'document-list', 'description'=>'Dostęp do listy dokumentów'];
        $this->privilages[] = ['tag'=>'document', 'key'=>'document-del', 'description'=>'Możliwość usuwania dokumentów'];
        $this->privilages[] = ['tag'=>'document', 'key'=>'document-print', 'description'=>'Możliwość drukowania dokumentów'];
        
        $this->privilages[] = ['tag'=>'production', 'key'=>'production-list', 'description'=>'Dostęp do listy produkcji'];
        $this->privilages[] = ['tag'=>'production', 'key'=>'production-del', 'description'=>'Możliwość usuwania produkcji'];
        $this->privilages[] = ['tag'=>'production', 'key'=>'production-edit', 'description'=>'Możliwość edycji produkcji'];
        $this->privilages[] = ['tag'=>'production', 'key'=>'production-income', 'description'=>'Możliwość dodawania przychodów'];
        $this->privilages[] = ['tag'=>'production', 'key'=>'production-outcome', 'description'=>'Możliwość dodawania rozchodów'];
        $this->privilages[] = ['tag'=>'production', 'key'=>'production-worker', 'description'=>'Możliwość dodawania pracowników'];
        
        $this->privilages[] = ['tag'=>'worker', 'key'=>'worker-list', 'description'=>'Dostęp do listy pracowników'];
        $this->privilages[] = ['tag'=>'worker', 'key'=>'worker-del', 'description'=>'Możliwość usuwania pracowników'];
        $this->privilages[] = ['tag'=>'worker', 'key'=>'worker-edit', 'description'=>'Możliwość edycji pracowników'];
    }

    private function setGroups() {
        $this->groups = ['Admin'];
    }

    private function setGroupsPrivilages() {
        $allPrivilages = [];
        foreach($this->privilages as $privilage){
            $allPrivilages[] = $privilage['key'];
        }
        $this->groupsPrivilages['Admin'] = $allPrivilages;
    }

    private function install() {
        $this->installPrivilages();
        $this->installGroups();
        $this->installGroupsPrivilages();
    }

    private function installPrivilages() {
        foreach ($this->privilages as $privilage) {
            $id = $this->db()->getOne('select id from privilage where `key`=?', $privilage['key']);
            if (!isset($id)) {
                $this->db()->execute('insert into privilage set `key`=:key, description=:description, tag=:tag', $privilage);
            }
        }
    }

    private function installGroups() {
        foreach ($this->groups as $group) {
            $id = $this->db()->getOne('select id from `group` where `name`=?', $group);
            if (!isset($id)) {
                $this->db()->execute('insert into `group` set name=?', $group);
            }
        }
    }

    private function installGroupsPrivilages() {
        foreach ($this->groupsPrivilages as $group => $privilages) {
            $groupId = $this->db()->getOne('select id from `group` where `name`=?', $group);
            foreach ($privilages as $privilage) {
                $privilageId = $this->db()->getOne('select id from privilage where `key`=?', $privilage);
                $id = $this->db()->getOne('select id from group_privilage where group_id=? and privilage_id=?', [$groupId, $privilageId]);
                if (!isset($id)) {
                    $this->db()->execute('insert into group_privilage set group_id=?, privilage_id=?', [$groupId, $privilageId]);
                }
            }
        }
    }

}
