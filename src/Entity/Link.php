<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="links")
 * @UniqueEntity("shortCode", message="Sorry, choose another shortcode")
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
     *
     * @Assert\Url()
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $originalUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $shortCode;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $token;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $expiresAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\StatisticsEntry", mappedBy="link")
     */
    private $statistics;

    /**
     * Link constructor.
     */
    public function __construct()
    {
        $this->statistics = new ArrayCollection();
    }

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
    public function getShortCode(): ?string
    {
        return $this->shortCode;
    }

    /**
     * @param string $shortCode
     */
    public function setShortCode(string $shortCode): void
    {
        $this->shortCode = $shortCode;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getExpiresAt(): int
    {
        return $this->expiresAt;
    }

    /**
     * @param int $expiresAt
     */
    public function setExpiresAt(int $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getStatistics(): ?Collection
    {
        return $this->statistics;
    }
}