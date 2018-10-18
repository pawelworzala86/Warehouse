<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Curl;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Integration\Model\OauthModel;
use App\Module\Integration\Model\ProductAllegroModel;
use App\Module\Integration\Request\AllegroSendRequest;
use App\Response\SuccessResponse;

class AllegroSendHandler extends Handler
{
    public function __invoke(AllegroSendRequest $request): SuccessResponse
    {
        $product = (new ProductModel)
            ->load($request->getId(), true);

        $oauth = (new OauthModel)
            ->load(3);

        $curl = new Curl;
        /*$curl->setHeaders([
            'Authorization: Bearer '.$oauth->getToken(),
            'accept: application/vnd.allegro.public.v1+json',
            'content-type: image/png',
            'accept-language: pl-PL',
            '--data-binary: @file_to_upload.png',
        ]);
        $data = file_get_contents(DIR.'/DemoImg/Product/34944_272081.png');
        $response = $curl->post('https://upload.allegro.pl.allegrosandbox.pl/sale/images', $data);
        $response = json_decode($response);*/
        //print_r($response);

        $offer = [
            'name' => 'Test',
            "category" => [
                "id" => "48879",
            ],
            /*"parameters" => [
                [
                    "id" => "11323",
                    "valuesIds" => [
                        "11323_1"
                    ],
                    "values" => [],
                    "rangeValue" => null
                ],
                [
                    "id" => "128188",
                    "valuesIds" => [
                        "128188_1"
                    ],
                    "values" => [],
                    "rangeValue" => null
                ],
                [
                    "id" => "127448",
                    "valuesIds" => [
                        "127448_1"
                    ],
                    "values" => [],
                    "rangeValue" => null
                ],
                [
                    "id" => "4386",
                    "valuesIds" => [
                        "4386_1"
                    ],
                    "values" => [],
                    "rangeValue" => null
                ],
                [
                    "id" => "219",
                    "valuesIds" => [
                        "219_2",
                        "219_256",
                        "219_4"
                    ],
                    "values" => [],
                    "rangeValue" => null
                ]
            ],*/
            "ean" => "6901443187416",
            "description" => [
                "sections" => [
                    [
                        "items" => [
                            [
                                "type" => "TEXT",
                                "content" => "<p>Tekstowy opis przedmiotu</p>"
                            ],
                            [
                                "type" => "IMAGE",
                                "url" => "https://e.allegroimg.com/original/01fd60/4ea8d18e4275b0878b7f0562067e"
                            ]
                        ]
                    ],
                    [
                        "items" => [
                            [
                                "type" => "TEXT",
                                "content" => "<p>Tekstowy opis przedmiotu</p>"
                            ]
                        ]
                    ]
                ]
            ],
            "images" => [
                [
                    "url" => 'https://e.allegroimg.com/original/01fd60/4ea8d18e4275b0878b7f0562067e'
                ],
            ],
            /*"compatibilityList" => [
                "items" => [
                    ["text" => "Skoda FABIA II (542) 1.2 TDI 75 KM / 55 KW 1199 ccm"],
                    ["text" => "BMW 3 (E46) 330 d 204 KM / 150 kW 2993 ccm"],
                    ["text" => "BMW 3 (E46) 330 i 231 KM / 170 kW 2979 ccm"],
                    ["text" => "BMW 3 (E46) 330 xi 231 KM / 170 kW 2979 ccm"],
                ]
            ],*/
            "sellingMode" => [
                "format" => "BUY_NOW",
                "price" => [
                    "amount" => "1499",
                    "currency" => "PLN",
                ],
                "startingPrice" => null,
                "minimalPrice" => null,
            ],
            "stock" => [
                "available" => 4,
                "unit" => "UNIT",
            ],
            "publication" => [
                "duration" => null,
                "status" => "INACTIVE",
                "startingAt" => null,
                "endingAt" => null,
            ],
            "delivery" => [
                "shippingRates" => [
                    "id" => "23b5a2f3-cbd5-42bb-ae3c-c9b43e9833ea",
                ],
                "handlingTime" => "PT168H",
                "additionalInfo" => "Dodatkowe informacje o dostawie",
                "shipmentDate" => "2018-04-01T08:00:00Z",
            ],
            "payments" => [
                "invoice" => "NO_INVOICE",
            ],
            /*"afterSalesServices" => [
                "impliedWarranty" => [
                    "id" => "b0590fac-9858-4d01-8487-1c6a09c55a68"
                ],
                "returnPolicy" => [
                    "id" => "c27c2ddd-f587-44db-b3c8-1f181964ea4d"
                ],
                "warranty" => [
                    "id" => "f8694df6-f020-4a27-ac0a-f4f959969e14"
                ]
            ],*/
            "additionalServices" => null,
            "sizeTable" => null,
            "promotion" => [
                "emphasized" => true,
                "bold" => false,
                "highlight" => false,
                "departmentPage" => false,
                "emphasizedHighlightBoldPackage" => false
            ],
            "location" => [
                "countryCode" => "PL",
                "province" => "WIELKOPOLSKIE",
                "city" => "Poznań",
                "postCode" => "60-166"
            ],
            "external" => [
                "id" => "moj werhouse id"
            ],
            //"contact" => null,
            /*"validation" => [
                "errors" => [],
                "validatedAt" => "2018-10-19T08:29:37.461Z"
            ],*/
            //"createdAt" => "2018-04-06T08:26:32Z",
            //"updatedAt" => "2018-04-06T08:29:38.664Z"
        ];

        $curl->setHeaders([
            'Authorization: Bearer ' . $oauth->getToken(),
            'accept: application/vnd.allegro.public.v1+json',
            'Content-Type: application/vnd.allegro.public.v1+json',
        ]);
        $response = $curl->post('https://api.allegro.pl.allegrosandbox.pl/sale/offers', json_encode($offer));
        $response = json_decode($response);

        /*$response = $curl->get('https://api.allegro.pl.allegrosandbox.pl/after-sales-service-conditions/implied-warranties?seller.id=44067401');
        $response = json_decode($response);
        print_r($response);
        exit;*/

        //$response = $curl->get('https://api.allegro.pl.allegrosandbox.pl/sale/offers/'.$response->id);
        //$response = json_decode($response);
        print_r($response);
        exit;

        (new ProductAllegroModel)
            ->setUuid(Common::getUuid())
            ->setProductId($product->getId())
            ->setAllegroId($response->id)
            ->insert();

        return new SuccessResponse;
    }
}