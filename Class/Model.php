<?php

namespace App;

use App\DB;
use App\Privilage;

class Model
{

    private $db;

    public function __construct()
    {
        $this->db = DB::get();
    }

    public function db()
    {
        return $this->db;
    }

    public function checkPrivilage($privilage)
    {
        return Privilage::check($privilage);
    }

    public function header($url)
    {
        $url = str_replace('Location: ', '', $url);
        echo json_encode(['redirect'=>$url]);
        exit;
    }

}
