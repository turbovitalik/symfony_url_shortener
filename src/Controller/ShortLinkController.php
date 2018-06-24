<?php

namespace App\Controller;

use App\Repository\LinkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShortLinkController extends Controller
{
    /**
     * @Route("/s/{code}", name="short_code")
     */
    public function followAction(string $code, LinkRepository $linkRepository)
    {
        $link = $linkRepository->findByShortCode($code);

        $originalUrl = $link->getOriginalUrl();

        return $this->redirect($originalUrl);
    }
}