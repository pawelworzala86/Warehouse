<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Curl;
use App\Handler;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Channel\Collection\ChannelCollection;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Files\Model\FileModel;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\File;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\SKU;
use App\User;

class PrestaRefreshHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        //define('PS_HOST_NAME', 'prestashop.localhost');
        //define('PS_WS_AUTH_KEY', 'GV5QM1CQP218HD2SIRVX1LENDFAIVM8S');

        $channels = (new ChannelCollection)
            ->where('deleted', '=', 0)
            ->where('added_by', '=', User::getId())
            ->load();

        while($channel = $channels->current()) {
            $PS_WS_AUTH_KEY = $channel->getKey();
            $PS_HOST_NAME = $channel->getHost();

            $curl = new Curl;
            $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/orders';
            $data = $curl->get($url);
            $xml = simplexml_load_string($data, null, LIBXML_NOCDATA);
            $prestaOrders = $xml->children()->children();

            foreach ($prestaOrders->order as $order) {
                $orderId = (string)$order['id'];

                $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/orders/' . $orderId;
                $data = $curl->get($url);
                $prestaOrderXML = simplexml_load_string($data, null, LIBXML_NOCDATA);
                $prestaOrder = $prestaOrderXML->children()->children();

                $orderModel = (new OrderModel)
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
                            ->setName('presta_id')
                            ->setKind(new FilterKind('='))
                            ->setValue($prestaOrder->id)
                    )
                    ->load();
                if ($orderModel->getId()) {
                    $orderModel
                        ->setUuid($orderModel->getUuid())
                        ->setTotalPaid((float)$prestaOrder->total_paid_real)
                        ->update();
                } else {
                    $type = 'ord';
                    $numberModel = (new DocumentNumberModel)
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
                                ->setName('type')
                                ->setKind(new FilterKind('='))
                                ->setValue($type)
                        )
                        ->load();
                    if (!$numberModel->getId()) {
                        $id = (new DocumentNumberModel)
                            ->setUuid(Common::getUuid())
                            ->setNumber(0)
                            ->setMonth(10)
                            ->setYear(2018)
                            ->setType($type)
                            ->insert();
                        $numberModel = (new DocumentNumberModel)
                            ->load($id);
                    }
                    $number = $numberModel->getNumber() + 1;
                    $year = $numberModel->getYear();
                    $month = $numberModel->getMonth();
                    $typesNames = [
                        'fvp' => 'FV-Z',
                        'pz' => 'PZ',
                        'fvs' => 'FV',
                        'wz' => 'WZ',
                        'ord' => 'Z',
                    ];
                    $name = $typesNames[$type] . '/' . $number . '/' . $year;
                    (new DocumentNumberModel)
                        ->setUuid($numberModel->getUuid())
                        ->setNumber($number)
                        ->update();

                    $gross = (float)$prestaOrder->total_paid;
                    $vat = ((float)$prestaOrder->total_paid / 123) * 100;
                    $net = $gross - $vat;

                    $shippingPrice = (float)$prestaOrder->total_shipping;
                    (new OrderModel)
                        ->setUuid(Common::getUuid())
                        ->setNumber($name)
                        ->setContractorId(1)
                        ->setAddressId(1)
                        ->setPrestaId($prestaOrder->id)
                        ->setDate(date("Y-m-d", time()))
                        ->setSumNet($net)
                        ->setSumVat($vat)
                        ->setSumGross($gross)
                        ->setTotalPaid((float)$prestaOrder->total_paid_real)
                        ->insert();

                    $contractorModel = (new ContractorModel)
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
                                ->setName('presta_id')
                                ->setKind(new FilterKind('='))
                                ->setValue($prestaOrder->customer_id)
                        )
                        ->load();

                    if (!$contractorModel->getId()) {
                        $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/customers/' . $prestaOrder->id_customer;
                        $data = $curl->get($url);
                        $prestaCustomerXML = simplexml_load_string($data, null, LIBXML_NOCDATA);
                        $prestaCustomer = $prestaCustomerXML->children()->children();

                        $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/addresses/' . $prestaOrder->id_address_delivery;
                        $data = $curl->get($url);
                        $prestaAddresXML = simplexml_load_string($data, null, LIBXML_NOCDATA);
                        $addressCustomer = $prestaAddresXML->children()->children();

                        $addressId = (new AddressModel)
                            ->setName(((string)$addressCustomer->company !== '') ? $addressCustomer->company : $prestaCustomer->firstname . ' ' . $prestaCustomer->lastname)
                            ->setFirstName($addressCustomer->firstname)
                            ->setLastName($addressCustomer->lastname)
                            ->setStreet($addressCustomer->address1 . ' ' . $addressCustomer->address2)
                            ->setPostcode($addressCustomer->postcode)
                            ->setCity($addressCustomer->city)
                            ->insert();

                        $contactId = (new ContractorContactModel)
                            ->setMail($prestaCustomer->email)
                            ->setPhone($addressCustomer->phone)
                            ->insert();

                        (new ContractorModel)
                            ->setUuid(Common::getUuid())
                            ->setCode('P-' . (string)$prestaOrder->customer_id)
                            ->setName(((string)$addressCustomer->company !== '') ? $addressCustomer->company : $prestaCustomer->firstname . ' ' . $prestaCustomer->lastname)
                            ->setAddressId($addressId)
                            ->setContactId($contactId)
                            ->setPrestaId($prestaOrder->customer_id)
                            ->insert();
                        //print_r($prestaCustomer);
                    }

                    foreach ($prestaOrder->associations->order_rows->order_row as $row) {
                        $prestaProductId = (string)$row->product_id;

                        $product = (new ProductModel)
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
                                    ->setName('presta_id')
                                    ->setKind(new FilterKind('='))
                                    ->setValue($prestaProductId)
                            )
                            ->load();
                        $productId = null;
                        if (!$product->getId()) {
                            $productId = (new ProductModel)
                                ->setUuid(Common::getUuid())
                                ->setName($row->product_name)
                                ->setSku(!empty((string)$row->product_reference) ? new SKU((string)$row->product_reference) : new SKU(substr_replace(Common::getUuid(), 0, 8)))
                                ->setPrestaId($prestaProductId)
                                ->setSellNet(round((float)$row->unit_price_tax_excl, 2))
                                ->setVat('23')
                                ->setSellGross(round((float)$row->unit_price_tax_incl, 2))
                                ->setDescriptionShort((string)$row->description_short->language)
                                ->setDescriptionFull((string)$row->description->language)
                                ->insert();

                            $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . 'images/products/' . $prestaProductId;
                            $data = $curl->get($url);
                            $prestaImageXML = simplexml_load_string($data, null, LIBXML_NOCDATA);
                            $prestaImage = $prestaImageXML->children()->children();
                            $index = 1;
                            foreach ($prestaImage->declination as $img) {
                                $data = @file_get_contents($url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/images/products/' . $prestaProductId . '/' . $img['id']);
                                $name = trim(strtok($row->product_name . ($index++), '?'));
                                $name = str_replace(' ', '-', $name);
                                file_put_contents(DIR . '/Files/' . $name . '.jpg', $data);
                                $fileUuid = (new File)
                                    ->setName($name)
                                    ->setType('image/jpg')
                                    ->setUuid(Common::getUuid())
                                    ->setUrl('/Files/' . $name . '.jpg')
                                    ->setSize(filesize(DIR . '/Files/' . $name . '.jpg'))
                                    ->save();
                                $fileModel = (new FileModel)
                                    ->load($fileUuid, true);
                                (new ProductFilesModel)
                                    ->setUuid(Common::getUuid())
                                    ->setFileId($fileModel->getId())
                                    ->setProductId($productId)
                                    ->insert();
                            }
                        } else {
                            $productId = $product->getId();
                        }

                        (new OrderProductModel)
                            ->setUuid(Common::getUuid())
                            ->setProductId($productId)
                            ->setOrderId($orderId)
                            ->setCount((float)$row->product_quantity)
                            ->setNet(round((float)$row->unit_price_tax_excl, 2))
                            ->setVat('23')
                            ->setSumNet(round((float)$row->unit_price_tax_excl * (float)$row->product_quantity, 2))
                            ->setSumGross(round((float)$row->unit_price_tax_incl * (float)$row->product_quantity, 2))
                            ->setSku(!empty((string)$row->product_reference) ? new SKU((string)$row->product_reference) : new SKU(substr_replace(Common::getUuid(), 0, 8)))
                            ->setName($row->product_name)
                            ->insert();
                    }

                    $productModel = (new ProductModel)
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
                                ->setName('name')
                                ->setKind(new FilterKind('='))
                                ->setValue('Przesyłka')
                        )->load();

                    $shippmentId = $productModel->getId();
                    if (!$shippmentId) {
                        $shippmentId = (new ProductModel)
                            ->setUuid(Common::getUuid())
                            ->setSku(new SKU(substr(Common::getUuid(), 0, 8)))
                            ->setName('Przesyłka')
                            ->insert();
                    }

                    (new OrderProductModel)
                        ->setUuid(Common::getUuid())
                        ->setProductId($shippmentId)
                        ->setSku(new SKU(''))
                        ->setName('Przesyłka')
                        ->setOrderId($orderId)
                        ->setCount(1)
                        ->setNet(round($shippingPrice / (123) * 100, 2))
                        ->setVat('23')
                        ->setSumNet(round($shippingPrice / (123) * 100, 2))
                        ->setSumGross(round($shippingPrice, 2))
                        ->insert();
                }
            }
            $channels->next();
        }

        return new SuccessResponse;
    }
}