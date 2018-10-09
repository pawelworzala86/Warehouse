<?php

namespace App\Module\Channel\Handler;

use App\Common;
use App\Handler;
use App\Module\Channel\Model\ChannelModel;
use App\Module\Channel\Response\CreateChannelResponse;
use App\Module\Channel\Request\CreateChannelRequest;

class CreateChannelHandler extends Handler
{

    public function __invoke(CreateChannelRequest $request): CreateChannelResponse
    {
        $uuid = Common::getUuid();

        (new ChannelModel)
            ->setUuid($uuid)
            ->setName($request->getName())
            ->insert();

        return (new CreateChannelResponse)
            ->setId($uuid);
    }

}