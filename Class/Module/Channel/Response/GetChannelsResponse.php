<?php

namespace App\Module\Channel\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Container\Channel;
use App\Container\Channels;

class GetChannelsResponse extends Response
{
    public $fieldClass = Channel::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    public $channels;

    function setChannels(Channels $channels): GetChannelsResponse
    {
        $this->channels = $channels;
        return $this;
    }

    function getChannels(): Channels
    {
        return $this->channels;
    }
}