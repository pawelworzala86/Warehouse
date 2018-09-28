<?php

namespace App\Module\Session\Handler;

use App\Handler;
use App\Module\Session\Response\CreateSessionResponse;
use App\Request\EmptyRequest;
use App\Type\SESSID;

class CreateSessionHandler extends Handler
{

    public function __invoke(EmptyRequest $request): CreateSessionResponse
    {
        $sessid = new SESSID(['sessid'=>session_id()]);

        return (new CreateSessionResponse)
            ->setId($sessid);
    }

}