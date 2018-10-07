<?php

namespace App\Module\Integration\Allegro;

use App\Integration\Allegro\Auction;
use App\Integration\Allegro\Field\Varchar;
use App\Integration\Allegro\Field\Integer;

class Allegro {

    private $client;
    private $userLogin;
    private $userPassword;
    private $webapiKey;
    private $sessionHandle;
    private $userId;

    public function __construct($userLogin, $userPassword, $webapiKey) {
        $this->userLogin = $userLogin;
        $this->userPassword = $userPassword;
        $this->webapiKey = $webapiKey;
        $this->client = new \SoapClient('https://webapi.allegro.pl.allegrosandbox.pl/service.php?wsdl');
        $this->client->soap_defencoding = 'UTF-8';
        $this->client->decode_utf8 = false;
    }

    public function login() {
        $status = $this->client->doQuerySysStatus(array(
            'sysvar' => 1,
            'countryId' => 1,
            'webapiKey' => $this->webapiKey
        ));
        $response = $this->client->doLogin(array(
            'userLogin' => $this->userLogin,
            'userPassword' => $this->userPassword,
            'countryCode' => 1,
            'webapiKey' => $this->webapiKey,
            'localVersion' => $status->verKey,
        ));
        $this->sessionHandle = $response->sessionHandlePart;
        $this->userId = $response->userId;
        return true;
    }

    public function getInfo($itemId) {
        $response = $this->client->doShowItemInfoExt([
            'sessionHandle' => $this->sessionHandle,
            'itemId' => $itemId,
        ]);
        return $response;
    }

    public function send(Auction $auction) {
        $response = $this->client->doNewAuctionExt(array(
            'sessionHandle' => $this->sessionHandle,
            'fields' => array(
                (new Varchar(1, $auction->getTitle()))->get(),
                array(
                    'fid' => 2,
                    'fvalueString' => '',
                    'fvalueInt' => 48879, //id kategori
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 4,
                    'fvalueString' => '',
                    'fvalueInt' => 2, //7dni
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 5,
                    'fvalueString' => '',
                    'fvalueInt' => 10, //liczba sztuk
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 8,
                    'fvalueString' => '',
                    'fvalueInt' => 0,
                    'fvalueFloat' => 9.99, //kup teraz
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 9,
                    'fvalueString' => '',
                    'fvalueInt' => 1, //kraj - polska
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 10,
                    'fvalueString' => '',
                    'fvalueInt' => 1, // Województwo
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 11,
                    'fvalueString' => 'Poznan',
                    'fvalueInt' => 0,
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 12,
                    'fvalueString' => '',
                    'fvalueInt' => 1, // Transport [Kupujący pokrywa koszty transportu]
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 14,
                    'fvalueString' => '',
                    'fvalueInt' => 1, // Formy płatności [Platne z gory (przelew)]
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 15,
                    'fvalueString' => '',
                    'fvalueInt' => 8, // Opcje dodatkowe [Wyróżnienie]
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 24,
                    'fvalueString' => 'tesst tset eset tst', // Opis [Opis testowej aukcji.]
                    'fvalueInt' => 0,
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 29,
                    'fvalueString' => '',
                    'fvalueInt' => 0, // Format sprzedaży [Aukcja (z licytacją) lub Kup Teraz!]
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 32,
                    'fvalueString' => '60-687', // Kod pocztowy [60-687]
                    'fvalueInt' => 0,
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 35,
                    'fvalueString' => '',
                    'fvalueInt' => 1, // Darmowe opcje przesyłki [Odbiór osobisty]
                    'fvalueFloat' => 0,
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
                array(
                    'fid' => 36,
                    'fvalueString' => '',
                    'fvalueInt' => 0,
                    'fvalueFloat' => 9.50, // Paczka pocztowa ekonomiczna (pierwsza sztuka) [9.50]
                    'fvalueImage' => 0,
                    'fvalueDatetime' => 0,
                    'fvalueDate' => '',
                    'fvalueRangeInt' => array(
                        'fvalueRangeIntMin' => 0,
                        'fvalueRangeInt-max' => 0
                    ),
                    'fvalueRange-float' => array(
                        'fvalueRangeFloatMin' => 0,
                        'fvalueRangeFloatMax' => 0,
                    ),
                    'fvalueRange-date' => array(
                        'fvalueRangeDateMin' => '',
                        'fvalueRangeDateMax' => '',
                    ),
                ),
            ),
        ));
        return $response->itemId;
    }

}

?>