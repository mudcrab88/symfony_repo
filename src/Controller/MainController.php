<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Message;

class MainController extends AbstractController
{
    private MessageRepository $msgRepository;
    private ObjectManager $entityManager;

    public function __construct(MessageRepository $msgRepository, ManagerRegistry $doctrine)
    {
        $this->msgRepository = $msgRepository;
        $this->entityManager = $doctrine->getManager();
    }


    #[Route('/', name: 'app')]
    public function index(): Response
    {
        return $this->render('main/main.html.twig', [
            'show_menu' => true,
            'user'      => $this->getUser()
        ]);
    }

    #[Route('/send', name: 'send')]
    public function send(Request $request): JsonResponse
    {
        $currentUser = $this->getUser();
        $result = [];

        $message = new Message();
        $message->setText($request->getContent());
        $message->setUser($currentUser);
        $message->setDatetime(new \DateTime());
        $this->entityManager->persist($message);
        $this->entityManager->flush();

        $result['message'] = ($currentUser === null) ? "Вы не авторизованы" : "{$currentUser->getId()}, ваше сообщение {$request->getContent()}!";

        return  new JsonResponse($result);
    }
}