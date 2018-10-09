<?php

namespace App\Module\Channel\Collection;

use App\Module\Channel\Model\ChannelModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class ChannelCollection extends ChannelModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}