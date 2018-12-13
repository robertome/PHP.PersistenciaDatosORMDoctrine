<?php

namespace MiW\Results\Service;


use MiW\Results\Entity\Result;
use MiW\Results\Utils;

class ResultService
{

    private $entityManager;
    private $repository;

    public function __construct()
    {
        $this->entityManager = EntityManager::getInstance();
        $this->repository = $this->entityManager->getRepository(Result::class);
    }

    public function create(Result $result): Result
    {
        $this->entityManager->persist($result);
        $this->entityManager->flush();
        return $result;
    }

    public function update(int $resultId, Result $result): ?Result
    {
        $currentResult = $this->findById($resultId);
        if (null === $currentResult) {
            return null;
        }

        $currentResult->merge($result);

        $this->entityManager->persist($currentResult);
        $this->entityManager->flush();
        return $currentResult;
    }

    public function delete(Result $result): ?Result
    {
        if (null === $result || null === $result->getId()) {
            return null;
        }

        $this->entityManager->remove($result);
        $this->entityManager->flush();
        return $result;
    }

    public function deleteById(int $resultId): ?Result
    {
        $result = $this->findById($resultId);
        if (null === $result) {
            return null;
        }

        return $this->delete($result);
    }

    public function findById(int $id)
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findByUserId(int $userId)
    {
        return $this->repository->findOneBy(['user_id' => $userId]);
    }

}