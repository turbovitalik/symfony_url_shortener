<?php

namespace App\Model;

use App\Entity\Link;
use App\Repository\LinkRepository;

class LinkManager
{
    /**
     * @var LinkRepository
     */
    private $linkRepository;

    /**
     * LinkManager constructor.
     * @param LinkRepository $linkRepository
     */
    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    /**
     * @param Link $link
     * @param string $shortCode
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function updateShortCode(Link $link, string $shortCode)
    {
        $exists = $this->linkRepository->findByShortCode($shortCode);

        if (!$exists) {
            $link->setShortCode($shortCode);
            $this->linkRepository->save($link);

            return true;
        }

        return false;
    }
}