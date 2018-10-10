<?php

namespace App\Module\Files\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Container\FileResponse;
use App\Container\FilesResponse;

class GetFilesResponse extends Response
{
    public $fieldClass = FileResponse::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    private $files;

    public function getFiles(): FilesResponse
    {
        return $this->files;
    }

    public function setFiles(FilesResponse $files)
    {
        $this->files = $files;
        return $this;
    }
}