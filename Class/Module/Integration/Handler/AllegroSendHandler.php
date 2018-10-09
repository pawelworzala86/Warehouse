<?php

namespace App\Module\Integration\Handler;

use App\Handler;
use App\Module\Integration\Allegro\Allegro;
use App\Module\Integration\Allegro\Auction;
use App\Module\Integration\Request\AllegroSendRequest;
use App\Response\SuccessResponse;

class AllegroSendHandler extends Handler
{
    public function __invoke(AllegroSendRequest $request): SuccessResponse
    {
        //$request->getId();

        $auction = new Auction;
        $auction->setTitle('kuku');

        $allegro = new Allegro('worzala86@gmail.com', '347142856ABab', 'cR5j03IqZapGQ0Z');
        $allegro->login();
        $result = $allegro->send($auction);

        print_r([$result]);

        return new SuccessResponse;
    }
}