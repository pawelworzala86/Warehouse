<?php

namespace App\Module\Order\Handler;

use App\Handler;
use App\Module\Order\Collection\OrderCollection;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Request\OrderAddRequest;
use App\Module\Order\Response\OrderCallResponse;
use App\Container\CallResponse;
use App\Container\CallResponses;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class OrderCallHandler extends Handler
{
    public function __invoke(OrderAddRequest $request): OrderCallResponse
    {
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
            foreach ($xml->error as $error) {
                if (isset($error->field)) {
                    echo $error->field . ': ';
                }
                echo $error->message;
                exit;
            }
        } else {
            echo 'Błąd komunikacji';
            exit;
        }


        $orders = (new OrderCollection)
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )->where(
                (new Filter)
                    ->setName('deleted')
                    ->setKind(new FilterKind('='))
                    ->setValue(0)
            )->where(
                (new Filter)
                    ->setName('pickup')
                    ->setKind(new FilterKind('null'))
                    ->setValue(null)
            )
            ->load();
        $ids = [];
        while ($order = $orders->current()) {
            $number = $order->getCourierNumber();
            if ($number) {
                $ids[] = $number;
            }
            $orders->next();
        }


        $method = 'packagesOrder';
        $format = 'xml';

        $params = array();

        $params['hash'] = $hash;
        $params['packages_ids'] = $ids;// identyfikatory wcześniej dodanych paczek

        $query = array();
        foreach ($params as $name => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $query[] = $name . "[" . $k . "]=" . urlencode($v);
                }
            } else {
                $query[] = "$name=" . urlencode($value);
            }
        }
        $query = implode('&', $query);

        $url = "http://test.furgonetka.pl/api/$method.$format?$query";

        $xml = simplexml_load_file($url);

        $status = $xml->getName();

        $ordersResponse = new CallResponses;

        if ($status == 'success') {
            //echo 'OK<br />';

            foreach ($xml->packages->node as $package) {
                $order = (new OrderModel)
                    ->where(
                        (new Filter)
                            ->setName('courier_number')
                            ->setKind(new FilterKind('='))
                            ->setValue($package->package_id)
                    )
                    ->load();
                $order
                    ->setUuid($order->getUuid())
                    ->setCourierNumberSecond($package->package_no)
                    ->setPickup($package->pickup)
                    ->update();

                $ordersResponse->add(
                    (new CallResponse)
                        ->setId($order->getUuid())
                        ->setPickup($package->pickup)
                );
                /*echo 'ID: '.$package->package_id.'<br />';
                echo 'NO: '.$package->package_no.'<br />';
                if(!empty($package->pickup)) {
                    echo 'Data przyjazdu kuriera: '.$package->pickup;
                }
                echo '<br />';*/
            }

        } elseif ($status == 'error') {
            foreach ($xml->error as $error) {
                if (isset($error->field)) {
                    echo $error->field . ': ';
                }
                echo $error->message;
                exit;
            }
        } else {
            echo 'Błąd komunikacji';
            exit;
        }


        return (new OrderCallResponse)
            ->setOrders($ordersResponse);
    }
}