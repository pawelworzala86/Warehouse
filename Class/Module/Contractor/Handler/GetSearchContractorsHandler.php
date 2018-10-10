<?php

namespace App\Module\Contractor\Handler;

use App\Handler;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Request\GetSearchContractorsRequest;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Module\Contractor\Response\GetSearchContractorsResponse;
use App\Container\Address;
use App\Container\Contractor;
use App\Container\Contractors;
use App\Container\Filter;
use App\Type\FilterKind;
use App\Container\Pagination;
use App\User;

class GetSearchContractorsHandler extends Handler
{
    public function __invoke(GetSearchContractorsRequest $request): GetSearchContractorsResponse
    {
        $pagination = new Pagination;
        $pagination->setLimit(5);
        $pagination->setPage(1);

        $contractorsCollection = (new ContractorCollection)
            ->setPagination($pagination)
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->where(new Filter([
                'name' => 'name',
                'kind' => new FilterKind('%'),
                'value' => $request->getSearch(),
            ]));
        if($request->getSupplier()) {
            $contractorsCollection->where(new Filter([
                'name' => 'supplier',
                'kind' => new FilterKind('='),
                'value' => true,
            ]));
        }
        $contractors = $contractorsCollection->load();

        $docs = new Contractors;
        $docs->rewind();
        $contractors->rewind();
        while($contractor = $contractors->current()){
            $con = (new ContractorModel)
                ->load($contractor->getId());
            $addressModel = (new AddressModel)
                ->load($con->getAddressId());
            $address = new Address;
            if($addressModel->isLoaded()){
                $address->setFirstName($addressModel->getFirstName())
                    ->setLastName($addressModel->getLastName())
                    ->setStreet($addressModel->getStreet())
                    ->setPostcode($addressModel->getPostcode())
                    ->setName($addressModel->getName())
                    ->setCity($addressModel->getCity())
                    ->setId($addressModel->getUuid());
            }
            $add = (new Contractor)
                ->setId($contractor->getUuid())
                ->setName($contractor->getName())
                ->setAddress($address)
                ->setCode($contractor->getCode());
            $docs->add($add);
            $contractors->next();
        }

        return (new GetSearchContractorsResponse)
            ->setContractors($docs);
    }
}