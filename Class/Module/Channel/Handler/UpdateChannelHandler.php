<?php

namespace App\Module\Channel\Handler;

use App\Common;
use App\Handler;
use App\Module\Channel\Model\ChannelModel;
use App\Module\Channel\Request\UpdateChannelRequest;
use App\Response\SuccessResponse;

class UpdateChannelHandler extends Handler
{

    public function __invoke(UpdateChannelRequest $request): SuccessResponse
    {
        (new ChannelModel)
            ->setUuid($request->getId())
            ->setName($request->getName())
            ->setHost($request->getHost())
            ->setKey($request->getKey())
            ->update();

        return new SuccessResponse;
    }

}