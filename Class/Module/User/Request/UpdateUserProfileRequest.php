<?php

namespace App\Module\User\Request;

use App\Request\Request;
use App\Type\Address;
use App\Type\Contact;
use App\Type\ProfileInvoice;

class UpdateUserProfileRequest extends Request
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