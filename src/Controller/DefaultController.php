<?php

namespace App\Controller;


use App\Entity\Link;
use App\Form\LinkType;
use App\Repository\LinkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function addAction(Request $request, LinkRepository $linkRepository)
    {
        $pageName = 'Add new link page';

        $link = new Link();

        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $linkRepository->save($link);

            $this->addFlash(
                'notice',
                'Short link was created'
            );

            return $this->redirectToRoute('link_details', ['id' => 1]);
        }

        return $this->render('default/add.html.twig', [
            'page' => $pageName,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/link/{id}", name="link_details", requirements={"id": "\d+"})
     */
    public function linkDetailsAction(Request $request, int $id)
    {
        return $this->render('default/link_details.html.twig', []);
    }
}