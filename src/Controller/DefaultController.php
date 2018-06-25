<?php

namespace App\Controller;

use App\Form\LinkType;
use App\Model\LinkManager;
use App\Service\ShortCode\GeneratorInterface;
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
    public function addAction(Request $request, GeneratorInterface $shortCodeGenerator, TokenGeneratorInterface $tokenGenerator, LinkManager $linkManager)
    {
        $form = $this->createForm(LinkType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $expiresIn = $form->get('expires_in')->getData();
            $token = $tokenGenerator->generateToken();
            $originalUrl = $form->get('originalUrl')->getData();

            $newLink = $linkManager->createLink($token, $expiresIn, $originalUrl);

            $shortCode = $form->get('shortCode')->getData();
            if (!$shortCode) {
                $shortCode = $shortCodeGenerator->generateShortCode($newLink);
            }

            $newLink->setShortCode($shortCode);

            $linkManager->updateLink($newLink);

            $this->addFlash(
                'notice',
                'Short link was created'
            );

            return $this->render('default/link_details.html.twig', ['link' => $newLink]);
        }

        return $this->render('default/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}