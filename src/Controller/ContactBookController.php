<?php

namespace App\Controller;

use App\Service\ContactDeserializer;
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
        ContactDeserializer $deserializer,
        Request $request
    ): Response {
        $requestBody = $request->getContent();

        $contact = $deserializer->deserialize($requestBody);

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
        ContactDeserializer $deserializer,
        Request $request,
        int $id
    ): Response {
        $requestBody = $request->getContent();

        $contact = $deserializer->deserialize($requestBody);

        $manager->set($id, $contact);
        return new JsonResponse([
            'message' => 'le contact a bien été remplacé',
        ]);
    }
}
