<?php

namespace App\Repository;

use App\Entity\Link;
use Doctrine\ORM\EntityManagerInterface;

class LinkRepository
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * LinkRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Link::class);
    }

    /**
     * @param Link $link
     */
    public function save(Link $link)
    {
        $this->entityManager->persist($link);
        $this->entityManager->flush();
    }
}