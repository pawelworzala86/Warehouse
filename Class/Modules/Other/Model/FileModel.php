<?php

namespace App\Modules\Other\Model;

use App\Model;
use App\Common;

class FileModel extends Model
{

    private $link;

    public function setLink(string $link){
        $this->link = $link;
        return $this;
    }

    public function save(): int
    {

        $this->db()->execute('insert into file (link, sys_unique_id) values (:link, :sys_unique_id)', [
            'link' => '/' . $this->link,
            'sys_unique_id' => Common::getRandomChars(),
        ]);
        return $this->db()->insertId();
    }

}
