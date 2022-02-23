<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Form\AvisType;
use App\Entity\Avis;
use App\Form\CantineType;
use App\Entity\Cantine;
use App\Entity\Identite;
use App\Form\IdentiteType;


class BaseController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        $repoAvis = $this->getDoctrine()->getRepository(Avis::class);
        $avis = $repoAvis->findAll();
        return $this->render('base/index.html.twig', [
            'avis' => $avis
        ]);
    }


    #[Route('/formavis', name: 'formavis')]
    public function formavis(Request $request, MailerInterface $mailer): Response
    {
        $formavis = new avis();
        $form = $this->createForm(AvisType::class, $formavis);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $email = (new Email())
                ->from($form->get('email')->getData())
                ->to('delfossesomain@gmail.com')
                ->subject($form->get('prenom')->getData())
                ->subject($form->get('nom')->getData())
                ->subject($form->get('nombre')->getData())
                ->text($form->get('message')->getData());

                $formavis->setDateEnvoi(new \Datetime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($formavis);
                $em->flush();
              
                $mailer->send($email);

                $this->addFlash('notice','Message envoyé');
               return $this->redirectToRoute('formavis');
            }
        }
        return $this->render('base/formavis.html.twig', [ 
            'form' => $form->createView()
        ]);
    }


    #[Route('/apropos', name: 'apropos')]
    public function apropos(Request $request): Response 
    {
        return $this->render('base/apropos.html.twig', [ 
            
        ]);
    }


    #[Route('/cantine', name: 'cantine')]
    public function cantine(Request $request, MailerInterface $mailer): Response
    {

        $cantine = new cantine();
        $form = $this->createForm(CantineType::class, $cantine);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $email = (new Email())
                ->from($form->get('email')->getData())
                ->to('delfossesomain@gmail.com')
                ->subject($form->get('prenom')->getData())
                ->subject($form->get('nom')->getData())
                ->date($form->get('repas')->getData())
                ->subject($form->get('NomDeLecole')->getData());

                $cantine->setDateEnvoi(new \Datetime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($cantine);
                $em->flush();
              
                

               $this->addFlash('notice','votre demande a été prise en compte');
               return $this->redirectToRoute('cantine');
            }
        }
        return $this->render('base/cantine.html.twig', [ 
            'form' => $form->createView()
        ]);
    }


    #[Route('/identite', name: 'identite')]
    public function identite(Request $request): Response 
    {

        $identite = new identite();
        $form = $this->createForm(IdentiteType::class, $identite);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $email = (new Email())
                ->from($form->get('email')->getData())
                ->to('delfossesomain@gmail.com')
                ->subject($form->get('prenom')->getData())
                ->subject($form->get('nom')->getData())
                ->date($form->get('naissance')->getData())
                ->subject($form->get('adresse')->getData());

                $identite->setDateEnvoi(new \Datetime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($identite);
                $em->flush();
              
                

               $this->addFlash('notice','votre demande a été prise en compte');
               return $this->redirectToRoute('identite');
            }
        }
        return $this->render('base/identite.html.twig', [ 
            'form' => $form->createView()
        ]);
    }
}
