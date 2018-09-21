<?php

namespace App\Modules\Other\Controller;

use App\Controller;
use App\Integration\Allegro\Allegro;
use App\Integration\Allegro\Auction;
use App\Modules\Other\Model\SendModel;

class Send extends Controller
{

    public function __construct()
    {
        $this->model = new SendModel;

        parent::__construct();
    }

    public function __invoke()
    {
        $links = [];

        if (!is_array($_POST['id'])) {
            $_POST['id'] = [$_POST['id']];
        }

        foreach ($_POST['id'] as $item) {
            $product = $this->model->getProduct($item);

            $itemId = null;
            $allegro = new Allegro('rozwala_pl', 'f7b04cb413B92bba', 'sf7b04cb');
            if ($allegro->login()) {
                $auction = new Auction();
                $auction->setTitle($product['name']);

                $itemId = $allegro->send($auction);
                //print_r($allegro->getInfo('6958394380'));
            }
            //echo '<a target="newTab" href="https://allegro.pl.webapisandbox.pl/listing?string=' . $itemId . '">' . $itemId . '</a>';
            //$this->assign('product', $this->model->getProduct($id));
            //$this->display('Product');
            $this->model->addAuction($product['id'], $itemId, 'allegro');
            $links[] = [
                'itemId' => $itemId,
                'auction' => 'allegro'
            ];
        }

        echo json_encode($links);
        exit;
    }

}
