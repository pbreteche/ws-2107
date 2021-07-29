<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ContactDeserializer
{

    public function deserialize(string $jsonContact): array
    {
        if (!$jsonContact) {
            throw new BadRequestException('il faut un corps pour ajouter un contact');
        }

        $contact = json_decode($jsonContact, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new BadRequestException('erreur de format json');
        }

        return $contact;
    }
}