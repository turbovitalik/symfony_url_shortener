<?php

namespace App\Service;

use App\Entity\Link;

class TinyWebShortener implements LinkShortenerInterface
{
    public function shorten(Link $link): Link
    {
        $shortLink = '/IamShort';
        $link->setShortUrl($shortLink);

        return $link;
    }
}