<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Files\Collection\FileCollection;
use App\Module\Files\Model\FileModel;
use App\Module\Files\Request\GetFilesRequest;
use App\Module\Files\Response\GetFilesResponse;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\File;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\SKU;
use App\User;
use PshopWs\Entities\PShopWsOrders;

require_once('/var/www/werhouse/Class/Module/Integration/WebService/PSWebServiceLibrary.php');

class PrestaRefreshHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        define('PS_HOST_NAME', 'prestashop.localhost');
        define('PS_SHOP_PATH', 'http://' . PS_HOST_NAME);
        define('PS_WS_AUTH_KEY', 'GV5QM1CQP218HD2SIRVX1LENDFAIVM8S');

        $webService = new \PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, false);
        $opt = array('resource' => 'orders');
        $xml = $webService->get($opt);
        $prestaOrders = $xml->children()->children();

        foreach ($prestaOrders->order as $order) {
            $orderId = (string)$order['id'];

            $opt = array('resource' => 'orders', 'id' => $orderId);
            $xml = $webService->get($opt);
            $prestaOrder = $xml->children()->children();
            //print_r($prestaOrder);

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
            if (!$orderModel->getId()) {
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
                //print_r([$prestaOrder]);
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
                //print_r($prestaOrder);
                if (!$contractorModel->getId()) {
                    $opt = array('resource' => 'customers', 'id' => $prestaOrder->id_customer);
                    $xml = $webService->get($opt);
                    $prestaCustomer = $xml->children()->children();

                    $opt = array('resource' => 'addresses', 'id' => $prestaOrder->id_address_delivery);
                    $xml = $webService->get($opt);
                    $addressCustomer = $xml->children()->children();

                    //print_r($addressCustomer);

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
                        ->setName(((string)$addressCustomer->company !== '') ? $addressCustomer->company : $prestaCustomer->firstname . ' ' . $prestaCustomer->lastname)
                        ->setAddressId($addressId)
                        ->setContactId($contactId)
                        ->insert();
                    //print_r($prestaCustomer);
                }

                foreach ($prestaOrder->associations->order_rows->order_row as $row) {
                    $prestaProductId = (string)$row->product_id;

                    //$opt = array('resource' => 'products', 'id' =>$prestaProductId);
                    //$xml = $webService->get($opt);
                    //$prestaProduct = $xml->children()->children();
                    //foreach($prestaProduct->associations->images->image as $image){
                    //$imageId = $image['id'];
                    /*$opt = array('resource' => 'images/products', 'id' =>$imageId);
                    $xml = $webService->get($opt);
                    $prestaImage = $xml->children()->children();
                    print_r($prestaImage);*/
                    //}

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
                            ->setSku(new SKU(substr_replace(Common::getUuid(), 0, 8)))
                            ->setPrestaId($prestaProductId)
                            ->setSellNet(round((float)$row->unit_price_tax_excl, 2))
                            ->setVat('23')
                            ->setSellGross(round((float)$row->unit_price_tax_incl, 2))
                            ->insert();
                        $opt = array('resource' => 'images/products', 'id' => $productId);
                        $xml = $webService->get($opt);
                        $prestaImage = $xml->children()->children();
                        $index = 1;
                        foreach ($prestaImage->declination as $img) {
                            $data = @file_get_contents($url = 'http://' . PS_WS_AUTH_KEY . '@' . PS_HOST_NAME . '/api/images/products/' . $prestaProductId . '/' . $img['id']);
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
                    //print_r([$row]);
                    (new OrderProductModel)
                        ->setUuid(Common::getUuid())
                        ->setProductId($productId)
                        ->setOrderId($orderId)
                        ->setCount((float)$row->product_quantity)
                        ->setNet(round((float)$row->unit_price_tax_excl, 2))
                        ->setVat('23')
                        ->setSumNet(round((float)$row->unit_price_tax_excl * (float)$row->product_quantity, 2))
                        ->setSumGross(round((float)$row->unit_price_tax_incl * (float)$row->product_quantity, 2))
                        ->setSku(new SKU(substr(Common::getUuid(), 0, 6)))
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
                $productId = $productModel->getId();
                if (!$productId) {
                    $productId = (new ProductModel)
                        ->setUuid(Common::getUuid())
                        ->setSku(new SKU(''))
                        ->setName('Przesyłka')
                        ->insert();
                }

                (new OrderProductModel)
                    ->setUuid(Common::getUuid())
                    ->setProductId($productId)
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

        return new SuccessResponse;
    }
}