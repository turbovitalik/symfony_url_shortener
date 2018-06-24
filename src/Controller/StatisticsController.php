<?php

namespace App\Controller;


use App\Repository\LinkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StatisticsController extends Controller
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

        $statistics = $link->getStatistics();
        $visitsCount = $statistics->count();

        return $this->render('statistics/index.html.twig', [
            'statistics' => $statistics,
            'visitsCount' => $visitsCount,
        ]);
    }
}