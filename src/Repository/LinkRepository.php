<?php

namespace App\Repository;

use App\Entity\Link;

class LinkRepository extends BaseEntityRepository
{
    public function findByShortCode($code): ?Link
    {
        return $this->getRepository()->findOneBy(['shortUrl' => $code]);
    }

    public function findByToken($token): ?Link
    {
        return $this->getRepository()->findOneBy(['token' => $token]);
    }

    /**
     * @param Link $link
     */
    public function save(Link $link)
    {
        $this->entityManager->persist($link);
        $this->entityManager->flush();
    }

    /**
     * @return string
     */
    protected function getEntityClass(): string
    {
        return Link::class;
    }
}