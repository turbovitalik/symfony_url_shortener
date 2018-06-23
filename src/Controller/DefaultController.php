<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $pageName = 'Index page';

        return $this->render('default/index.html.twig', [
            'page' => $pageName,
        ]);
    }

    /**
     * @Route("/add", name="add_link")
     */
    public function addAction()
    {
        $pageName = 'Add new link page';

        return $this->render('default/add.html.twig', [
            'page' => $pageName,
        ]);
    }
}