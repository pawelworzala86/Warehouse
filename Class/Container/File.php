<?php

namespace App\Container;

use App\Common;
use App\DB;
use App\IP;
use App\Container;
use App\Type\UUID;
use App\User;

class File extends Container
{
    private $url;
    private $data;
    private $db;
    private $uuid;
    private $name;
    private $type;
    private $size;

    public function __construct($datas = null)
    {
        parent::__construct($datas);
        $this->db = DB::get();
    }

    function getSize(): ?int
    {
        return $this->size;
    }

    function setSize(int $size = null): File
    {
        $this->size = $size;
        return $this;
    }

    function getType(): string
    {
        return $this->type;
    }

    function setType(string $type): File
    {
        $this->type = $type;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }

    function setName(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    function setUuid(UUID $uuid=null): File
    {
        $this->uuid = $uuid;
        return $this;
    }

    function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    function setData(string $data): File
    {
        $this->data = $data;
        return $this;
    }

    function getData(): string
    {
        return $this->data;
    }

    function setUrl(string $url = null): File
    {
        $this->url = $url;
        return $this;
    }

    function getUrl(): ?string
    {
        return $this->url;
    }

    function db()
    {
        return $this->db;
    }

    function save($saveToFileSystem = true): string
    {
        if(!isset($this->uuid)&&$saveToFileSystem) {
            $this->uuid = Common::getUuid();
            $this->setUrl(DIR.'/Files/' . $this->uuid);
            file_put_contents(DIR . $this->getUrl(), base64_decode($this->getData()));
            if (file_exists(DIR . $this->getUrl())) {
                $this->setSize(filesize(DIR . $this->getUrl()));
            }
        }else if(!$saveToFileSystem){
            $this->uuid = Common::getUuid();
        }
        $uuid = hex2bin($this->uuid);
        $params = [
            $uuid,
            time(),
            User::getId(),
            IP::getId(),
            $this->getUrl(),
            $this->getSize(),
            $this->getName(),
            $this->getType(),
        ];
        $this->db()->execute('insert into file (uuid, added, added_by, added_ip_id, `url`, `size`, `name`, `type`) values '.
            '(?, ?, ?, ?, ?, ?, ?, ?)', $params);

        return $this->uuid;
    }
}