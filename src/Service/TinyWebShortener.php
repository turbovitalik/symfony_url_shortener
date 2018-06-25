<?php

namespace App\Service;

use App\Entity\Link;

class TinyWebShortener implements LinkShortenerInterface
{
    /**
     * @var string
     */
    protected $availableChars = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    /**
     * @param Link $link
     * @return string
     * @throws \Exception
     */
    public function generateShortCode(Link $link): string
    {
        $shortCode = $this->convertIdToShortCode($link->getId());

        return $shortCode;
    }

    /**
     * @param int $id
     * @return string
     * @throws \Exception
     */
    private function convertIdToShortCode(int $id): string
    {
        if ($id < 1) {
            throw new \InvalidArgumentException("ID could not be less than 1");
        }

        $setLength = strlen($this->availableChars);

        if ($setLength < 15) {
            throw new \Exception("Set of available chars is not strong enough");
        }

        $shortCode = "";
        while ($id > $setLength - 1) {
            $shortCode = $this->availableChars[fmod($id, $setLength)] . $shortCode;
            $id = floor($id / $setLength);
        }

        $shortCode = $this->availableChars[$id] . $shortCode;

        return $shortCode;
    }
}