<?php

namespace App\Module\Channel\Handler;

use App\Handler;
use App\Module\Channel\Model\ChannelModel;
use App\Module\Channel\Request\GetChannelRequest;
use App\Module\Channel\Response\GetChannelResponse;

class GetChannelHandler extends Handler
{
    public function __invoke(GetChannelRequest $request): GetChannelResponse
    {
        $channel = (new ChannelModel)
            ->load($request->getId(), true);

        return (new GetChannelResponse)
            ->setId($channel->getUuid())
            ->setName($channel->getName())
            ->setHost($channel->getHost())
            ->setKey($channel->getKey());
    }
}