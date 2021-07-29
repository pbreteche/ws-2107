<?php

namespace App\Controller;

use App\Service\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function show(
        ContactManager $manager,
        int $id
    ): Response {
        return $this->json($manager->get($id));
    }

    /**
     * @Route("/", methods="POST")
     */
    public function add(
        ContactManager $manager,
        Request $request
    ): Response {
        $requestBody = $request->getContent();

        if (!$requestBody) {
            return new JsonResponse([
                'message' => 'il faut un corps pour ajouter un contact',
            ], Response::HTTP_BAD_REQUEST);
        }

        $contact = json_decode($requestBody, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return new JsonResponse([
                'message' => 'erreur de format json',
            ], Response::HTTP_BAD_REQUEST);
        }

        $manager->push($contact);
        return new JsonResponse([
            'message' => 'le contact a bien été inséré',
        ], Response::HTTP_CREATED);
    }
    /**
     * @Route("/{id}", requirements={"id": "\d+"}, methods="PUT")
     */
    public function put(
        ContactManager $manager,
        Request $request,
        int $id
    ): Response {
        $requestBody = $request->getContent();

        if (!$requestBody) {
            return new JsonResponse([
                'message' => 'il faut un corps pour ajouter un contact',
            ], Response::HTTP_BAD_REQUEST);
        }

        $contact = json_decode($requestBody, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return new JsonResponse([
                'message' => 'erreur de format json',
            ], Response::HTTP_BAD_REQUEST);
        }

        $manager->set($id, $contact);
        return new JsonResponse([
            'message' => 'le contact a bien été remplacé',
        ]);
    }
}
