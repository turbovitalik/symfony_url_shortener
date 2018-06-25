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
     * @param $accessToken
     * @param $expiresIn
     * @param $originalUrl
     * @return Link
     */
    public function createLink($accessToken, $expiresIn, $originalUrl): Link
    {
        $link = new Link();
        $link->setExpiresAt(time() + $expiresIn);
        $link->setToken($accessToken);
        $link->setOriginalUrl($originalUrl);

        $this->linkRepository->save($link);

        return $link;
    }

    /**
     * @param Link $link
     */
    public function updateLink(Link $link)
    {
        $this->linkRepository->save($link);
    }
}