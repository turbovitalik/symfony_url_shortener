<?php

namespace App\Service;

use App\Entity\Link;
use App\Entity\StatisticsEntry;
use App\Repository\StatisticsRepository;
use Symfony\Component\HttpFoundation\Request;

class DbLogger implements StatLoggerInterface
{
    /**
     * @var StatisticsRepository
     */
    private $statisticsRepository;

    /**
     * DbLogger constructor.
     * @param StatisticsRepository $statisticsRepository
     */
    public function __construct(StatisticsRepository $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    /**
     * @param Request $request
     * @param Link $link
     */
    public function logRequestData(Request $request, Link $link)
    {
        $userAgentData = $request->headers->get('User-Agent');

        $logEntry = new StatisticsEntry();
        $logEntry->setUserAgent($userAgentData);
        $logEntry->setLink($link);

        $this->statisticsRepository->save($logEntry);
    }
}