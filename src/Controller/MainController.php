<?php

namespace App\Controller;

use App\Service\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    private MessageService $service;

    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }


    #[Route('/', name: 'app')]
    public function index(): Response
    {
        $messages = $this->service->getMessagesAsArray();

        return $this->render('main/main.html.twig', [
            'show_menu' => true,
            'user'      => $this->getUser(),
            'messages'  => $messages
        ]);
    }

    #[Route('/send', name: 'send')]
    public function send(Request $request): JsonResponse
    {
        $currentUser = $this->getUser();
        $result = [];

        $message = $this->service->create(json_decode($request->getContent()), $currentUser);
        $this->service->save($message);

        $result['message'] = ($currentUser === null) ? "Вы не авторизованы" : "Ваше сообщение {$message->getFullText()}!";

        return  new JsonResponse($result);
    }
}