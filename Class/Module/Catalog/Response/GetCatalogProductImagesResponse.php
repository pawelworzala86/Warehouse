<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Type\FileResponse;
use App\Type\FilesResponse;

class GetCatalogProductImagesResponse extends Response
{
    public $fieldClass = FileResponse::class;

    private $files;

    function setFiles(FilesResponse $files): GetCatalogProductImagesResponse
    {
        $this->files = $files;
        return $this;
    }

    function getFiles(): FilesResponse
    {
        return $this->files;
    }
}