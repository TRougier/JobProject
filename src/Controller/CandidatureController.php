<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\CandidatureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidatureController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(EntityManagerInterface $em): Response
    {
        $candidatures = $em->getRepository(Candidature::class)->findAll();

        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidatures,
        ]);
    }

    #[Route('/candidature/new', name: 'candidature_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $candidature = new Candidature();
        
        $form = $this->createForm(CandidatureType::class, $candidature);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($candidature);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('candidature/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offres', name: 'app_offres')]
    public function offres(): Response
    {
        return $this->render('offres/index.html.twig');
    }

}
