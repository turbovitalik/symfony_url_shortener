<?php

namespace App\Service;

use App\Entity\Link;

interface LinkShortenerInterface
{
    public function generateShortCode();
}