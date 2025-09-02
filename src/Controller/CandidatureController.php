<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\CandidatureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class CandidatureController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            // Si l'utilisateur n'est pas connecté, on redirige vers login
            return $this->redirectToRoute('app_login');
        }

        // Récupère uniquement les candidatures de l'utilisateur connecté
        $candidatures = $em->getRepository(Candidature::class)->findBy(['user' => $user]);

        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidatures,
        ]);
    }

    #[Route('/candidature/new', name: 'candidature_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On associe la candidature à l'utilisateur connecté
            $candidature->setUser($user);

            $em->persist($candidature);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('candidature/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/candidature/{id}/edit', name: 'candidature_edit')]
    public function edit(Request $request, Candidature $candidature, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user || $candidature->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous ne pouvez modifier que vos propres candidatures.');
        }

        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('candidature/edit.html.twig', [
            'form' => $form->createView(),
            'candidature' => $candidature,
        ]);
    }

    #[Route('/candidature/{id}/statut', name: 'candidature_update_statut', methods: ['POST'])]
    public function updateStatut(Request $request, Candidature $candidature, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user || $candidature->getUser() !== $user) {
            return new JsonResponse(['success' => false, 'message' => 'Accès refusé'], 403);
        }

        $newStatut = $request->request->get('statut');
        if (!in_array($newStatut, ['Candidature', 'Relance', 'Entretien'])) {
            return new JsonResponse(['success' => false, 'message' => 'Statut invalide'], 400);
        }

        $candidature->setStatut($newStatut);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }


    #[Route('/candidature/{id}/delete', name: 'candidature_delete')]
    public function delete(Candidature $candidature, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user || $candidature->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous ne pouvez supprimer que vos propres candidatures.');
        }

        $em->remove($candidature);
        $em->flush();

        return $this->redirectToRoute('app_home');
    }

    #[Route('/offres', name: 'app_offres')]
    public function offres(): Response
    {
        return $this->render('offres/index.html.twig');
    }
}
