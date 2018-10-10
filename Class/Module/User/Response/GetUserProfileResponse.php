<?php

namespace App\Module\User\Response;

use App\Response\Response;
use App\Container\Address;
use App\Container\Contact;
use App\Container\ProfileInvoice;

class GetUserProfileResponse extends Response
{
    private $address;
    private $contact;
    private $invoice;

    public function getInvoice(): ?ProfileInvoice
    {
        return $this->invoice;
    }

    public function setInvoice(ProfileInvoice $invoice = null)
    {
        $this->invoice = $invoice;
        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact = null)
    {
        $this->contact = $contact;
        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address = null)
    {
        $this->address = $address;
        return $this;
    }
}