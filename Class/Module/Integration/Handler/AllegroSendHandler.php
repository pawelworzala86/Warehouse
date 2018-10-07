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

        $allegro = new Allegro('rozwala_pl', 'f7b04cb413B92bba', 'sf7b04cb');
        $allegro->login();
        $result = $allegro->send($auction);

        print_r([$result]);

        return new SuccessResponse;
    }
}