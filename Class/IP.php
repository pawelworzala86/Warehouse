<?php

namespace App;

class IP
{

    static private $ipId;

    static private function getIp()
    {
        $ip = null;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return ip2long($ip) ? ip2long($ip) : 1;
    }

    static public function getId()
    {
        if (User::getId()) {
            self::$ipId = DB::get()->getOne('select id from ip where ip=:ip and user_id=:user_id', [
                'ip' => self::getIp(),
                'user_id' => User::getId(),
            ]);
        } else {
            self::$ipId = DB::get()->getOne('select id from ip where ip=:ip', [
                'ip' => self::getIp(),
            ]);
        }
        if (!isset(self::$ipId)) {
            DB::get()->execute('insert into ip (ip, user_id, `date`) values (:ip, :user_id, :date)', [
                'ip' => self::getIp(),
                'user_id' => User::getId(),
                'date' => time(),
            ]);
            self::$ipId = DB::get()->insertId();
        }
        DB::get()->execute('update ip set `date`=:date where ip=:ip and user_id=:user_id', [
            'ip' => self::getIp(),
            'user_id' => User::getId(),
            'date' => time(),
        ]);
        return self::$ipId;
    }

}
