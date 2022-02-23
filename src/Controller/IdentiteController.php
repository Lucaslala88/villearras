<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Identite;

class IdentiteController extends AbstractController
{
    #[Route('/private-liste-identite', name: 'liste-identite')]
    public function index(): Response
    {
        $repoIdentite = $this->getDoctrine()->getRepository(Identite::class);
        $identites = $repoIdentite->findAll();
        return $this->render('base/liste-identite.html.twig', [
            'identites' => $identites
        ]);
    }
}
