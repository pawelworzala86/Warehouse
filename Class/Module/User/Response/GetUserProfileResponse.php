<?php

namespace App\Module\User\Response;

use App\Response\Response;
use App\Type\Address;
use App\Type\Contact;

class GetUserProfileResponse extends Response
{
    private $address;
    private $contact;

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