<?php

namespace App\Module\Integration\Handler;

use App\Container\Shipment;
use App\Container\Shipments;
use App\Curl;
use App\Handler;
use App\Module\Integration\Allegro\Allegro;
use App\Module\Integration\Allegro\Auction;
use App\Module\Integration\Model\OauthModel;
use App\Module\Integration\Request\AllegroSendRequest;
use App\Module\Integration\Response\AllegroGetShipmentResponse;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

class AllegroGetShipmentHandler extends Handler
{
    public function __invoke(EmptyRequest $request): AllegroGetShipmentResponse
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
        $response = $curl->get('https://api.allegro.pl.allegrosandbox.pl/sale/shipping-rates?seller.id=44067401');
        $response = json_decode($response);

        $shipments = new Shipments;
        foreach($response->shippingRates as $r){
            $shipments->add(
                (new Shipment)
                ->setId($r->id)
                ->setName($r->name)
            );
        }

        return (new AllegroGetShipmentResponse)
            ->setShipments($shipments);
    }
}