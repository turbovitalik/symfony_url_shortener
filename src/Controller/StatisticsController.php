<?php

namespace App\Controller;


use App\Repository\LinkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StatisticsController
{
    /**
     * @Route("/statistics/{token}", name="link_statistics")
     */
    public function indexAction(string $token, LinkRepository $linkRepository)
    {
        $link = $linkRepository->findByToken($token);

        if (!$link) {
            throw new NotFoundHttpException("There is no statistics available by this url");
        }
    }
}