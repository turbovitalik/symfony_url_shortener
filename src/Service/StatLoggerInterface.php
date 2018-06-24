<?php

namespace App\Service;

use App\Entity\Link;
use Symfony\Component\HttpFoundation\Request;

interface StatLoggerInterface
{
    public function logRequestData(Request $request, Link $link);
}