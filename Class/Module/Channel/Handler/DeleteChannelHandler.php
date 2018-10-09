<?php

namespace App\Module\Channel\Handler;

use App\Common;
use App\Handler;
use App\Module\Channel\Model\ChannelModel;
use App\Module\Channel\Request\DeleteChannelRequest;
use App\Module\Channel\Request\UpdateChannelRequest;
use App\Response\SuccessResponse;

class DeleteChannelHandler extends Handler
{

    public function __invoke(DeleteChannelRequest $request): SuccessResponse
    {
        (new ChannelModel)
            ->setUuid($request->getId())
            ->delete();

        return new SuccessResponse;
    }

}