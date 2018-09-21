<?php

namespace App\Types;

use App\TypeCollection;

class DebtsDocuments extends TypeCollection
{
    private $documents;

    public function getDocuments()
    {
        return $this->documents;
    }

    public function setDocuments($documents)
    {
        $this->documents = $documents;
        return $this;
    }

}