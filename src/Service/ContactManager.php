<?php

namespace App\Service;

class ContactManager
{
    private $contacts;

    public function __construct()
    {
        $this->contacts = include __DIR__.'/../../data/contacts.php';
    }

    public function getAll()
    {
        return $this->contacts;
    }
}