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

            //@todo: check shortcode for uniqueness


            //@todo: refactor this
            if (null === $link->getShortCode()) {
                $shortCode = $linkShortener->generateShortCode();
            } else {
                $shortCode = $form->get('shortCode')->getData();
            }

            $link->setShortCode($shortCode);

            $expiresIn = $form->get('expires_in')->getData();
            $token = $tokenGenerator->generateToken();


            $link->setToken($token);
            $link->setExpiresAt(time() + $expiresIn);

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