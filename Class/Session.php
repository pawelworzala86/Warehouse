<?php

namespace App;

use PHPMailer\PHPMailer\Exception;

class Session implements \SessionHandlerInterface
{
    private $db;

    public function __construct()
    {
        $this->db = DB::get();
        session_set_save_handler($this, true);

        $headers = getallheaders();
        if (isset($headers['X-Session-Id'])) {
            session_id($headers['X-Session-Id']);
            session_start();
        } else if (isset($_COOKIE[session_name()])) {
            session_id($_COOKIE[session_name()]);
            session_start();
        } else {
            $id = Common::getSessid();
            session_id($id);
            session_start();
            setcookie(session_name(), session_id(), time() + 3600, '/');
        }
    }

    private function db()
    {
        return $this->db;
    }

    public function open($savePath, $sessionName)
    {
        return true;
    }

    function close()
    {
        return true;
    }

    function read($id)
    {
        $data = $this->db()->getOne('select `data` from `session` where sessid=:sessid', ['sessid' => hex2bin($id)]);
        return $data ? $data : '';
    }

    function write($id, $data)
    {
        $id = hex2bin($id);
        $session = $this->db()->getRow('select sessid, deleted, user_id from session where sessid=:sessid', ['sessid' => $id]);
        if (isset($session['deleted'])&&$session['deleted']) {
            $id = Common::getSessid();
            session_id($id);
            $id = hex2bin($id);
            //throw new Exception('Session is deleted');
        }
        if ($session) {
            $this->db()->execute('update session set access=:access, data=:data, ip_id=:ip_id, user_id=:user_id where sessid=:sessid', [
                'sessid' => $id,
                'access' => time(),
                'data' => $data,
                'ip_id' => IP::getId(),
                'user_id' => User::getId() ? User::getId() : $session['user_id'],
            ]);
        } else {
            $this->db()->execute('insert into session (sessid, access, `data`, ip_id, user_id) values (?, ?, ?, ?, ?)', [
                $id, time(), $data, IP::getId(), User::getId()
            ]);
        }
        return true;
    }

    function destroy($id)
    {
        return $this->db()->execute('update session set deleted=? where sessid=?', [time(), hex2bin($id)]) ? true : false;
    }

    function gc($max)
    {
        return $this->db()->execute('update session set deleted=? where access=?', [time(), time() - $max]) ? true : false;
    }

}