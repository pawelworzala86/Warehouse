<?php

namespace App\Module\Order\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Module\Order\Request\DeleteOrderRequest;
use App\Module\Order\Request\UpdateOrderRequest;
use App\Response\SuccessResponse;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class DeleteOrderHandler extends Handler
{
    public function __invoke(DeleteOrderRequest $request): SuccessResponse
    {
        (new OrderModel)
            ->setUuid($request->getOrderId())
            ->delete();

        return new SuccessResponse;
    }
}