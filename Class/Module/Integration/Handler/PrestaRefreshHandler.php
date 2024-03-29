<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Container\Order;
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
use App\Module\Integration\Model\ContractorIntegrationModel;
use App\Module\Integration\Model\OrderIntegrationModel;
use App\Module\Integration\Model\ProductIntegrationModel;
use App\Module\Integration\Worker\PrestaWorker;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Container\File;
use App\Container\Filter;
use App\Type\FilterKind;
use App\Type\SKU;
use App\User;

class PrestaRefreshHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        $channels = (new ChannelCollection)
            ->where('deleted', '=', 0)
            ->where('added_by', '=', User::getId())
            ->load();

        while ($channel = $channels->current()) {
            $prestaWorker = new PrestaWorker($channel->getHost(), $channel->getKey());

            $prestaOrders = $prestaWorker->getOrders();
            foreach ($prestaOrders->order as $order) {
                $orderId = (string)$order['id'];

                $prestaOrder = $prestaWorker->getOrder($orderId);

                $orderIntegration = (new OrderIntegrationModel)
                    ->where('added_by', '=', User::getId())
                    ->where('deleted', '=', 0)
                    ->where('order_id', '=', $prestaOrder->id)
                    ->where('channel_id', '=', $channel->getId())
                    ->load();
                if ($orderIntegration->getId()) {
                    $orderModel = (new OrderModel)
                        ->load($orderIntegration->getOrderId());
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
                    $orderId = (new OrderModel)
                        ->setUuid(Common::getUuid())
                        ->setNumber($name)
                        ->setContractorId(1)
                        ->setAddressId(1)
                        ->setDate(date("Y-m-d", time()))
                        ->setSumNet($net)
                        ->setSumVat($vat)
                        ->setSumGross($gross)
                        ->setTotalPaid((float)$prestaOrder->total_paid_real)
                        ->setChannelId($channel->getId())
                        ->insert();

                    (new OrderIntegrationModel)
                        ->setUuid(Common::getUuid())
                        ->setChannelId($channel->getId())
                        ->setOrderId($orderId)
                        ->setPrestaId((string)$prestaOrder->id)
                        ->insert();

                    $contractorIntegration = (new ContractorIntegrationModel)
                        ->where('added_by', '=', User::getId())
                        ->where('deleted', '=', 0)
                        ->where('channel_id', '=', $channel->getId())
                        ->where('presta_id', '=', (string)$prestaOrder->id_customer)
                        ->load();
                    if (!$contractorIntegration->getId()) {
                        $prestaCustomer = $prestaWorker->getCustomer($prestaOrder->id_customer);
                        $addressCustomer = $prestaWorker->getAddress($prestaOrder->id_address_delivery);

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
                            ->setCode('P-' . (string)$channel->getId() . '-' . (string)$prestaOrder->id_customer)
                            ->setName(((string)$addressCustomer->company !== '') ? $addressCustomer->company : $prestaCustomer->firstname . ' ' . $prestaCustomer->lastname)
                            ->setAddressId($addressId)
                            ->setContactId($contactId)
                            ->insert();

                        (new ContractorIntegrationModel)
                            ->setUuid(Common::getUuid())
                            ->setChannelId($channel->getId())
                            ->setPrestaId((string)$prestaOrder->id_customer)
                            ->insert();
                    }

                    foreach ($prestaOrder->associations->order_rows->order_row as $row) {
                        $prestaProductId = (string)$row->product_id;
                        $sku = new SKU((string)$row->product_reference);

                        $productIntegration = (new ProductIntegrationModel)
                            ->where('deleted', '=', 0)
                            ->where('added_by', '=', User::getId())
                            ->where('channel_id', '=', $channel->getId())
                            ->where('sku', '=', (string)$row->product_reference)
                            ->load();
                        $productId = $productIntegration->getProductId();
                        if (!$productIntegration->getId()) {
                            $productId = (new ProductModel)
                                ->setUuid(Common::getUuid())
                                ->setName($row->product_name)
                                ->setSku($sku)
                                //->setPrestaId($prestaProductId)
                                ->setSellNet(round(((float)$row->unit_price_tax_excl/123)*100, 2))
                                ->setVat('23')
                                ->setSellGross(round((float)$row->unit_price_tax_excl, 2))
                                ->setDescriptionShort((string)$row->description_short->language)
                                ->setDescriptionFull((string)$row->description->language)
                                ->insert();

                            (new ProductIntegrationModel)
                                ->setUuid(Common::getUuid())
                                ->setChannelId($channel->getId())
                                ->setProductId($productId)
                                ->setSku($sku)
                                ->setPrestaId($prestaProductId)
                                ->insert();

                            $prestaImages = ($xml = $prestaWorker->getImages($prestaProductId))?$xml->children()->children():null;
                            $index = 1;
                            if ($prestaImages) {
                                foreach ($prestaImages->declination as $img) {
                                    $data = $prestaWorker->getImage($prestaProductId, $img['id']);
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
                            }
                        }

                        (new OrderProductModel)
                            ->setUuid(Common::getUuid())
                            ->setProductId($productId)
                            ->setOrderId($orderId)
                            ->setCount((float)$row->product_quantity)
                            ->setNet(round(((float)$row->unit_price_tax_incl/123)*100, 2))
                            ->setVat('23')
                            ->setSumNet(round((((float)$row->unit_price_tax_incl * (float)$row->product_quantity)/123)*100, 2))
                            ->setSumGross(round((float)$row->unit_price_tax_incl * (float)$row->product_quantity, 2))
                            ->setSku($sku)
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