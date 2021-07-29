<?php

namespace App\Service;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function get(int $id)
    {
        if (key_exists($id, $this->contacts)) {
            return $this->contacts[$id];
        }

        throw new NotFoundHttpException();
    }

    public function push($contact)
    {
        array_push($this->contacts, $contact);
    }
}