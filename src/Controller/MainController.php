<?php

namespace App\Controller;

use App\Service\MessageService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    private MessageService $msgService;
    private UserService $usrService;

    public function __construct(MessageService $msgService, UserService $usrService)
    {
        $this->msgService = $msgService;
        $this->usrService = $usrService;
    }


    #[Route('/', name: 'app')]
    public function index(): Response
    {
        $messages = $this->msgService->getMessagesAsArray();
        $activeUsers = $this->usrService->getActiveUsersArray();

        return $this->render('main/main.html.twig', [
            'show_menu'   => true,
            'user'        => $this->getUser(),
            'messages'    => $messages,
            'activeUsers' => $activeUsers
        ]);
    }

    #[Route('/send', name: 'send')]
    public function send(Request $request): JsonResponse
    {
        $currentUser = $this->getUser();
        $result = [];

        $message = $this->msgService->create($request->getContent(), $currentUser);
        $this->msgService->save($message);

        $result['message'] = ($currentUser === null) ? "Вы не авторизованы" : "Ваше сообщение {$message->getFullText()}!";

        return  new JsonResponse($result);
    }
}