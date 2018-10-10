<?php

namespace App\Module\Order\Handler;

use App\Handler;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Request\OrderAddRequest;
use App\Module\Order\Response\OrderAddResponse;

class OrderAddHandler extends Handler
{
    public function __invoke(OrderAddRequest $request): OrderAddResponse
    {
        $uuid = $request->getId();
        $courier = $request->getCourier();
        $orderModel = (new OrderModel)
            ->load($uuid, true);


        $method = 'login';
        $format = 'xml';

        $email = 'worzala86@gmail.com';
        $password = md5('347142856');

        $url = "http://test.furgonetka.pl/api/$method.$format?email=$email&password=$password";

        $xml = simplexml_load_file($url);

        //print_r($xml);

        $status = $xml->getName();

        //print_r([$status]);

        $hash = null;
        if ($status == 'success') {
            $hash = $xml->hash;
        } elseif ($status == 'error') {
            foreach($xml->error as $error) {
                if(isset($error->field)) {
                    echo $error->field .': ';
                }
                echo $error->message;
                exit;
            }
        } else {
            echo 'Błąd komunikacji';
            exit;
        }










        $method = 'packageAdd';
        $format = 'xml';

        $params['hash'] = $hash;
        $params['wrapping'] = 0;
        $params['shape'] = 0;

        $params['type'] = 'package';

        $params['sender_name'] = 'imię';
        $params['sender_surname'] = 'nazwisko';
        $params['sender_street'] = 'ulica 12/3';
        $params['sender_city'] = 'miasto';
        $params['sender_postcode'] = '00-001';
        $params['sender_phone'] = '789456123';
        $params['sender_email'] = 'test@pl.pl';

        $params['receiver_name'] = 'imię';
        $params['receiver_surname'] = 'nazwisko';
        $params['receiver_company']= 'nazwa firmy';
        $params['receiver_street'] = 'ulica 45/6';
        $params['receiver_city'] = 'miasto';
        $params['receiver_postcode'] = '00-002';
        $params['receiver_phone'] = '654987321';

        $params['weight'] = '10';
        $params['width'] = '11';
        $params['height'] = '12';
        $params['depth'] = '13';
        $params['description'] = 'Opis zawartości paczki';

        $params['service'] = $courier;

        $query = array();
        foreach ($params as $name => $value) {
            $query[] = "$name=" . urlencode($value);
        }
        $query = implode('&', $query);

        $url = "http://test.furgonetka.pl/api/$method.$format?$query";

        $xml = simplexml_load_file($url);

        $status = $xml->getName();

        if ($status == 'success') {
            //echo "Cena zamówionej paczki: $xml->price PLN<br />";
            //echo "Id paczki: $xml->package_id<br />";

            $orderModel
                ->setUuid($orderModel->getUuid())
                ->setCourier($params['service'])
                ->setCourierNumber($xml->package_id)
                ->setCourierPrice((float)$xml->price)
                ->update();

        } elseif ($status == 'error') {
            foreach($xml->error as $error) {
                if(isset($error->field)) {
                    echo $error->field .': ';
                }
                echo $error->message;
            }
        } else {
            echo 'Błąd';
        }








        /*$method = 'packageDetails';
        $format = 'xml';

        $hash = $hash;
        $package_no = $orderModel->getCourierNumber();

        $url = "http://test.furgonetka.pl/api/$method.$format?hash=$hash&package_no=$package_no";

        $xml = simplexml_load_file($url);

        $status = $xml->getName();
        if ($status == 'success') {
            foreach ((array)$xml->package as $name => $value) {
                echo "$name - $value<br />";
            }
            if(!empty($xml->label)) {
                $fileName = 'etykieta_' . $package_no . '.' . $xml->label->format;
                file_put_contents($fileName, base64_decode($xml->label->base64));
            }
            if(!empty($xml->protocol)) {
                $fileName = 'protokol_' . $package_no . '.' . $xml->protocol->format;
                file_put_contents($fileName, base64_decode($xml->protocol->base64));
            }
            if(!empty($xml->cod)) {
                $fileName = 'cod_' . $package_no . '.' . $xml->cod->format;
                file_put_contents($fileName, base64_decode($xml->cod->base64));
            }
        } elseif ($status == 'error') {
            foreach($xml->error as $error) {
                if(isset($error->field)) {
                    echo $error->field .': ';
                }
                echo $error->message;
            }
        } else {
            echo 'Błąd komunikacji';
        }*/







        return (new OrderAddResponse)
            ->setId($xml->package_id)
            ->setCourier($orderModel->getCourier())
            ->setCourierNumber($orderModel->getCourierPrice())
            ->setCourierNumber($orderModel->getCourierNumber());
    }
}