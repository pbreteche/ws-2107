<?php

namespace App\Controller;

use App\Service\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact-book", methods="GET")
 */
class ContactBookController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(
        ContactManager $manager
    ): Response {
        return $this->json($manager->getAll());
    }
}
