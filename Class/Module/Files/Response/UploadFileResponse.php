<?php

namespace App\Module\Files\Response;

use App\Response\Response;
use App\Type\FilesResponse;

class UploadFileResponse extends Response
{
    private $file;

    public function getFile(): FilesResponse
    {
        return $this->file;
    }

    public function setFile(FilesResponse $file)
    {
        $this->file = $file;
        return $this;
    }
}