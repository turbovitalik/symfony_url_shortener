<?php

namespace App\Controller;

use App\Repository\LinkRepository;
use App\Service\StatLoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShortLinkController extends Controller
{
    /**
     * @Route("/s/{code}", name="short_code")
     */
    public function followAction(string $code, Request $request, LinkRepository $linkRepository, StatLoggerInterface $statLogger)
    {
        $link = $linkRepository->findByShortCode($code);

        $statLogger->logRequestData($request, $link);

        $originalUrl = $link->getOriginalUrl();

        return $this->redirect($originalUrl);
    }
}