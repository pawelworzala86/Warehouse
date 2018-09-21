<?php

namespace App;

class Session implements \SessionHandlerInterface
{

    public function __construct()
    {
        session_set_save_handler($this, true);
        session_start();
    }

    public function open($savePath, $sessionName)
    {
        return DB::get() ? true : false;
    }

    function close()
    {
        return true;
    }

    function read($id)
    {
        return (string)DB::get()->getOne('select data from session where id=?', $id);
    }

    function write($id, $data)
    {
        return DB::get()->execute('replace into session values (?, ?, ?, ?, ?)', [$id, time(), $data, IP::getId(), User::getId()]) ? true : false;
    }

    function destroy($id)
    {
        return DB::get()->execute('delete from session where id=?', $id) ? true : false;
    }

    function gc($max)
    {
        return DB::get()->execute('delete from session where access=?', time() - $max) ? true : false;
    }

}