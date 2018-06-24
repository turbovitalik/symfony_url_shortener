<?php

namespace App\Controller;


use App\Entity\Link;
use App\Form\LinkType;
use App\Repository\LinkRepository;
use App\Service\LinkShortenerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

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
    public function addAction(Request $request, LinkRepository $linkRepository, LinkShortenerInterface $linkShortener, TokenGeneratorInterface $tokenGenerator)
    {
        $pageName = 'Add new link page';

        $link = new Link();

        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (null === $link->getShortUrl()) {
                $link = $linkShortener->shorten($link);
            }

            $token = $tokenGenerator->generateToken();
            $link->setToken($token);

            $linkRepository->save($link);

            $this->addFlash(
                'notice',
                'Short link was created'
            );

            return $this->render('default/link_details.html.twig', ['link' => $link]);
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