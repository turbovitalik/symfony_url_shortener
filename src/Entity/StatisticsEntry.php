<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="statistics")
 */
class StatisticsEntry
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $userAgent;

    /**
     * @var Link
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Link")
     */
    private $link;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return Link
     */
    public function getLink(): Link
    {
        return $this->link;
    }

    /**
     * @param Link $link
     */
    public function setLink(Link $link): void
    {
        $this->link = $link;
    }
}