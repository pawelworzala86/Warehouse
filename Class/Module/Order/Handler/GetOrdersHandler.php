<?php

namespace App\Module\Order\Handler;

use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Document\Model\DocumentModel;
use App\Module\Order\Collection\OrderCollection;
use App\Module\Order\Collection\OrderProductCollection;
use App\Module\Order\Model\OrderProductModel;
use App\Module\Order\Response\GetOrdersResponse;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\DocumentProduct;
use App\Type\DocumentProducts;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Order;
use App\Type\OrderResponse;
use App\Type\Orders;
use App\Type\OrdersResponse;
use App\User;

class GetOrdersHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetOrdersResponse
    {
        $ordersCollection = (new OrderCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )
            ->where(
                (new Filter)
                    ->setName('deleted')
                    ->setKind(new FilterKind('='))
                    ->setValue(0)
            )
            ->load();

        $orders = new OrdersResponse;

        $ordersCollection->rewind();
        while ($order = $ordersCollection->current()) {
            $document = (new DocumentModel);
            if ($order->getDocumentId()) {
                $document->load($order->getDocumentId());
            }
            $products = new DocumentProducts;
            $productsCollection = (new OrderProductCollection)
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
                        ->setName('order_id')
                        ->setKind(new FilterKind('='))
                        ->setValue($order->getId())
                )->load();
            while ($product = $productsCollection->current()) {
                $prod = (new ProductModel)
                    ->load($product->getProductId());
                $products->add(
                    (new DocumentProduct)
                        ->setId($product->getUuid())
                        ->setProductId($prod->getUuid())
                        ->setCount($product->getCount())
                        ->setNet($product->getNet())
                        ->setSumNet($product->getSumNet())
                        ->setSumGross($product->getSumGross())
                        ->setVat($product->getVat())
                        ->setName($prod->getName())
                );
                $productsCollection->next();
            }
            $orders->add(
                (new OrderResponse)
                    ->setId($order->getUuid())
                    ->setNumber($order->getNumber())
                    ->setCourier($order->getCourier())
                    ->setCourierNumber($order->getCourierNumber())
                    ->setCourierPrice($order->getCourierPrice())
                    ->setInvoiceNumber($document->getName())
                    ->setDocumentId($document->getUuid())
                    ->setPickup($order->getPickup())
                    ->setProducts($products)
            );
            $ordersCollection->next();
        }

        return (new GetOrdersResponse)
            ->setOrders($orders)
            ->setPagination($ordersCollection->getPagination())
            ->setFilters($ordersCollection->getFilters());
    }
}