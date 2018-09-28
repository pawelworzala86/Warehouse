<?php

namespace App\Module\Files\Request;

use App\Request\UserRequest;
use App\Type\Files;

class UploadFileRequest extends UserRequest
{
    private $file;

    public function getFile(): Files
    {
        return $this->file;
    }

    public function setFile(Files $file)
    {
        $this->file = $file;
        return $this;
    }
}