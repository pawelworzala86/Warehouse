<?php

namespace App\Module\Session\Handler;

use App\Handler;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\SESSID;

class DeleteSessionHandler extends Handler
{

    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        session_destroy();

        return new SuccessResponse;
    }

}