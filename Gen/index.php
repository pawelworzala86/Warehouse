<?php

namespace App;

require_once('../Config.php');

require_once(DIR.'/Api/index.php');

class AddTableToDatabase
{
    private $db;

    public function __construct()
    {
        $this->db = DB::get();
    }

    function add($tableName){
        $this->db->execute('create table if not exists '.$tableName.' (
            id int primary key auto_increment,
            uuid binary(16),
            unique(uuid),
            added int,
            added_by int,
            added_ip_id int,
            updated int,
            updated_by int,
            updated_ip_id int,
            deleted int default 0,
            deleted_by int,
            deleted_ip_id int,
            index(added_by),
            index(added_ip_id),
            index(updated_by),
            index(updated_ip_id),
            index(deleted_by),
            index(deleted_ip_id)
        )');
    }
}

$addTableToDatabase = new AddTableToDatabase;
$addTableToDatabase->add('order_product');