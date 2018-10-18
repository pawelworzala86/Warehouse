<?php

namespace App\Module\Integration\Handler;

use App\Handler;
use App\Module\Integration\Allegro\Allegro;
use App\Module\Integration\Allegro\Auction;
use App\Module\Integration\Request\AllegroSendRequest;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

class AllegroLoginHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        //$request->getId();

        /*$auction = new Auction;
        $auction->setTitle('kuku');

        $allegro = new Allegro('worzala86@gmail.com', '347142856ABab', 'a0a687c8a9b845bb956065b3e072924c');
        $allegro->login();
        $result = $allegro->send($auction);

        print_r([$result]);*/

        header('Location: https://allegro.pl.allegrosandbox.pl/auth/oauth/authorize?response_type=code&client_id=b585861a760e4daab66ac440e3515310&redirect_uri=http://werhouse.localhost/api/integration/allegro/oauth');
        exit;

        return new SuccessResponse;
    }
}