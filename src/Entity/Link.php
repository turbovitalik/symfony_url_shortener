<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="links")
 */
class Link
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $originalUrl;

    /**
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    private $shortUrl;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOriginalUrl(): ?string
    {
        return $this->originalUrl;
    }

    /**
     * @param string $originalUrl
     */
    public function setOriginalUrl(string $originalUrl): void
    {
        $this->originalUrl = $originalUrl;
    }

    /**
     * @return string
     */
    public function getShortUrl(): ?string
    {
        return $this->shortUrl;
    }

    /**
     * @param string $shortUrl
     */
    public function setShortUrl(string $shortUrl): void
    {
        $this->shortUrl = $shortUrl;
    }
}