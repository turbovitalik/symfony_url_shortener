<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\LinkType;
use App\Model\LinkManager;
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
    public function addAction(Request $request, LinkRepository $linkRepository, LinkShortenerInterface $linkShortener, TokenGeneratorInterface $tokenGenerator, LinkManager $linkManager)
    {
        $pageName = 'Add new link page';

        $link = new Link();

        $form = $this->createForm(LinkType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $link = $form->getData();

            //@todo: refactor this
            if (null !== $link->getShortCode()) {
                $shortCode = $form->get('shortCode')->getData();
                $link->setShortCode($shortCode);
            }


            $expiresIn = $form->get('expires_in')->getData();
            $token = $tokenGenerator->generateToken();


            $link->setToken($token);
            $link->setExpiresAt(time() + $expiresIn);

            $linkRepository->save($link);

            if (!$link->getShortCode()) {

                $shortCode = $linkShortener->generateShortCode($link);

                $updated = false;
                while (!$updated) {
                    $updated = $linkManager->updateShortCode($link, $shortCode);
                }

            }

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
}