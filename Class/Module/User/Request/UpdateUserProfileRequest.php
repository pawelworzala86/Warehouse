<?php

namespace App\Module\User\Request;

use App\Request\Request;
use App\Type\Address;
use App\Type\Contact;
use App\Type\Mail;
use App\Type\Password;

class UpdateUserProfileRequest extends Request
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