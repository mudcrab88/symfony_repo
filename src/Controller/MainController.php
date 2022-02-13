<?php

namespace App\Controller;

use App\DataTransferObject\MessageDTO;
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
        $status = 200;

        if ($currentUser === null) {
            $result['message'] = "Вы не авторизованы";
            $status = 401;
        } else {
            $dto = MessageDTO::fromRequest($request);

            $message = $this->msgService->create($request->getContent(), $currentUser);
            $this->msgService->save($message);
            $result['message'] = json_encode($dto);
        }

        return  new JsonResponse($result, $status);
    }

    #[Route('/edit', name: 'edit')]
    public function edit(Request $request): JsonResponse
    {
        $currentUser = $this->getUser();
        $result = [];
        $status = 200;

        return  new JsonResponse($result, $status);
    }
}