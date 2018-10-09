<?php

namespace App\Module\Channel\Handler;

use App\Handler;
use App\Module\Channel\Collection\ChannelCollection;
use App\Module\Channel\Response\GetChannelsResponse;
use App\Request\PaginationRequest;
use App\Type\Channel;
use App\Type\Channels;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetChannelsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetChannelsResponse
    {
        $channelsCollection = (new ChannelCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->load();

        $channelsList = new Channels();

        while ($channel = $channelsCollection->current()) {
            $channelsList->add(
                (new Channel)
                    ->setName($channel->getName())
                    ->setId($channel->getUuid())
            );
            $channelsCollection->next();
        }
        $channelsCollection->rewind();

        return (new GetChannelsResponse)
            ->setChannels($channelsList)
            ->setPagination($channelsCollection->getPagination())
            ->setFilters($channelsCollection->getFilters())
            ->setFiltersNames($channelsCollection->getFiltersNames());
    }
}