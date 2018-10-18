<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Curl;
use App\Handler;
use App\Module\Integration\Allegro\Allegro;
use App\Module\Integration\Allegro\Auction;
use App\Module\Integration\Model\OauthModel;
use App\Module\Integration\Request\AllegroOauthRequest;
use App\Module\Integration\Request\AllegroSendRequest;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

class AllegroOauthHandler extends Handler
{
    public function __invoke(AllegroOauthRequest $request): SuccessResponse
    {
        //$request->getId();

        /*$auction = new Auction;
        $auction->setTitle('kuku');

        $allegro = new Allegro('worzala86@gmail.com', '347142856ABab', 'a0a687c8a9b845bb956065b3e072924c');
        $allegro->login();
        $result = $allegro->send($auction);

        print_r([$result]);*/

        //header('Location: https://allegro.pl.allegrosandbox.pl/auth/oauth/authorize?response_type=code&client_id=b585861a760e4daab66ac440e3515310&redirect_uri=http://werhouse.localhost/api/integration/allegro/oauth');
        //exit;

        $curl = new Curl;
        //clientID:clientSecreet - base64
        $curl->setHeaders(['Authorization: Basic YjU4NTg2MWE3NjBlNGRhYWI2NmFjNDQwZTM1MTUzMTA6ZDRVU3huY2dwVlFyVXpqdHFpcDc0TUlySldwZmhGUnZTUE9HYlhZR0cxcExyaUhqbW9UU3kybjdXWGpJdzZtNg==']);
        $response = $curl->post('https://allegro.pl.allegrosandbox.pl/auth/oauth/token?grant_type=authorization_code&code=' .
            $request->getCode() .
            '&redirect_uri=http://werhouse.localhost/api/integration/allegro/oauth', '');
        $response = json_decode($response);

        $oauthId = (new OauthModel)
            ->setUuid(Common::getUuid())
            ->setIntegrationId(1)
            ->setToken($response->access_token)
            ->setRefreshToken($response->refresh_token)
            ->insert();

        print_r([$response]);
        exit;

        return new SuccessResponse;
    }
}