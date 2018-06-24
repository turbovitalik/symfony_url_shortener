<?php

namespace App\Repository;

use App\Entity\StatisticsEntry;

class StatisticsRepository extends BaseEntityRepository
{
    /**
     * @return string
     */
    protected function getEntityClass(): string
    {
        return StatisticsEntry::class;
    }

    /**
     * @param StatisticsEntry $entry
     * @TODO: move to superclass later
     */
    public function save(StatisticsEntry $entry)
    {
        $this->entityManager->persist($entry);
        $this->entityManager->flush();
    }
}