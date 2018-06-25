<?php

namespace App\Repository;

use App\Entity\Link;

class LinkRepository extends BaseEntityRepository
{
    /**
     * @param string $code
     * @param bool $onlyActive
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByShortCode(string $code, $onlyActive = true)
    {
        $now = time();

        $qb = $this->entityManager->createQueryBuilder()
            ->select('l')
            ->from('App:Link', 'l')
            ->andWhere('l.shortCode = :shortCode')
            ->setParameter('shortCode', $code)
        ;

        if ($onlyActive) {
            $qb
                ->andWhere('l.expiresAt > :now')
                ->setParameter('now', $now);

        }

        $query = $qb->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
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