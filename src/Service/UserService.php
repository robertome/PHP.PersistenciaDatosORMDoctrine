<?php

namespace MiW\Results\Service;


use MiW\Results\Entity\User;
use MiW\Results\Utils;

class UserService
{

    private $entityManager;
    private $repository;

    public function __construct()
    {
        $this->entityManager = Utils::getEntityManager();
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    public function create(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function update(int $userId, User $user): User
    {
        $currentUser = $this->findById($userId);
        if (null === $currentUser) {
            return null;
        }

        $currentUser->update($user);

        $this->entityManager->persist($currentUser);
        $this->entityManager->flush();
        return $currentUser;
    }

    public function delete(User $user): User
    {
        if (null === $user || null === $user->getId()) {
            return null;
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();
        return $user;
    }

    public function deleteById(int $userId): User
    {
        $user = $this->repository->findById($userId);
        if (null === $user) {
            return null;
        }

        return $this->delete($user);
    }

    public function findById(int $id)
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

}