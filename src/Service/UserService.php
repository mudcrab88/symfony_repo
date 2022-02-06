<?php

namespace App\Service;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    protected UserRepository $repository;
    protected ObjectManager $entityManager;

    public function __construct(UserRepository $repository, ManagerRegistry $doctrine)
    {
        $this->repository = $repository;
        $this->entityManager = $doctrine->getManager();
    }

    public function getActiveUsersArray(): array
    {
        $activeUsers = $this->repository->findActiveUsers();
        $result = [];

        foreach ($activeUsers as $user) {
            $result[] = [
                'id'   => $user['id'],
                'name' => $user['email']
            ];
        }

        return $result;
    }
}
