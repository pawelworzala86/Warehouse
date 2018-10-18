<?php

namespace App\Module\Integration\Handler;

use App\Curl;
use App\Handler;
use App\Module\Integration\Allegro\Allegro;
use App\Module\Integration\Allegro\Auction;
use App\Module\Integration\Model\OauthModel;
use App\Module\Integration\Request\AllegroSendRequest;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

class AllegroPrepareShipmentHandler extends Handler
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

        $oauth = (new OauthModel)
            ->load(3);

        $curl = new Curl;
        //clientID:clientSecreet - base64
        $curl->setHeaders([
            'Authorization: Bearer ' . $oauth->getToken(),
            'accept: application/vnd.allegro.public.v1+json',
            'content-type: application/vnd.allegro.public.v1+json',
        ]);
        $data = [
            "name" => "Nowy cennik dostawy",
            "rates" => [
                [
                    "deliveryMethod" => [
                        "id" => "7203cb90-864c-4cda-bf08-dc883f0c78ad"
                    ],
                    "maxQuantityPerPackage" => 1,
                    "firstItemRate" => [
                        "amount" => "7.99",
                        "currency" => "PLN"
                    ],
                    "nextItemRate" => [

                        "amount" => "0.00",
                        "currency" => "PLN"
                    ],
                    "shippingTime" => [
                        "from" => "PT72H",
                        "to" => "PT120H"
                    ],
                ],
            ]
        ];

        $post = json_encode($data);
        $response = $curl->post('https://api.allegro.pl.allegrosandbox.pl/sale/shipping-rates', $post);
        //$response = json_decode($response);

        print_r($response);
        exit;

        return new SuccessResponse;
    }
}