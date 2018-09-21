<?php

namespace App;

use App\DB;
use App\User;

class Privilage {

    static private $privilages;

    static private function loadPrivilages() {
        $groups = DB::get()->getAll('select group_id from user_group where user_id=?', User::getId());
        $privilagesIds = [];
        foreach ($groups as $group) {
            $privilages = DB::get()->getAll('select privilage_id from group_privilage where group_id=?', $group['group_id']);
            foreach ($privilages as $privilage) {
                $privilagesIds[] = $privilage['privilage_id'];
            }
        }
        $privilages = DB::get()->getAll('select `key` from privilage where id in (\''.join('\',\'', $privilagesIds).'\')');
        foreach ($privilages as $privilage) {
            self::$privilages[] = $privilage['key'];
        }
    }

    static public function check($privilage) {
        if (!isset(self::$privilages)) {
            self::loadPrivilages();
        }
        if (!isset($privilage)) {
            return true;
        }
        $return = false;
        if (!isset(self::$privilages)) {
            return false;
        }
        foreach (self::$privilages as $existedPrivilage) {
            if ($existedPrivilage === $privilage) {
                $return = true;
            }
        }
        return $return;
    }

}
