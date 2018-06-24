<?php

namespace App\Service;

class TinyWebShortener implements LinkShortenerInterface
{
    public function generateShortCode(): string
    {
        return 'IamShort';
    }
}