<?php

namespace App\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

abstract class BaseEntityRepository
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * BaseEntityRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return string
     */
    abstract protected function getEntityClass(): string;

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        if (!isset($this->repository)) {
            $entityClass = $this->getEntityClass();
            $this->repository = $this->entityManager->getRepository($entityClass);
        }

        return $this->repository;
    }
}