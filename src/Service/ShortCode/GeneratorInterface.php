<?php

namespace App\Service\ShortCode;

use App\Entity\Link;

interface GeneratorInterface
{
    public function generateShortCode(Link $link);
}