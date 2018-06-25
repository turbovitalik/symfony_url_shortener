<?php

namespace App\Service\Statistics;

use App\Entity\Link;
use Symfony\Component\HttpFoundation\Request;

interface StatLoggerInterface
{
    public function logRequestData(Request $request, Link $link);
}