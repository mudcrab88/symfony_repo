<?php

namespace App\Service;

use App\Entity\Message;
use App\Entity\User;
use App\Repository\MessageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;

class MessageService
{
    protected MessageRepository $repository;
    protected ObjectManager $entityManager;

    public function __construct(MessageRepository $repository, ManagerRegistry $doctrine)
    {
        $this->repository = $repository;
        $this->entityManager = $doctrine->getManager();
    }

    public function create(string $text, ?UserInterface $user): Message
    {
        $message = new Message();
        $text = json_decode($text, true)['message'];

        $message->setText($text);
        $message->setUser($user);
        $message->setDatetime(new \DateTime());

        return $message;
    }

    public function save(Message $message)
    {
        $this->entityManager->persist($message);
        $this->entityManager->flush();
    }

    public function getMessagesAsArray(): array
    {
        $messages = $this->repository->findAll();
        $result = [];
        foreach ($messages as $message) {
            $result[] = [
                'id'       => $message->getId(),
                'datetime' => $message->getDatetimeFormatted(),
                'username' => $message->getUser()->getUserIdentifier(),
                'text'     => $message->getText()
            ];
        }

        return $result;
    }
}