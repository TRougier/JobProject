<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    #[Route('/offres-emploi', name: 'app_offres')]
    public function index(): Response
    {
        $url = "https://fr.jooble.org/api/";
        $key = "c4b34436-3fdb-46cb-8a9e-7c7c42bda2eb"; // ta clé API

        $postData = json_encode([
            "keywords" => "développeur",
            "location" => "Paris"
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $key);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $jobs = []; // en cas d'erreur, tableau vide
        } else {
            $jobs = json_decode($response, true)['jobs'] ?? [];
            $jobs = array_slice($jobs, 0, 1);
        }

        curl_close($ch);

        return $this->render('offres/index.html.twig', [
            'jobs' => $jobs
        ]);
    }
}
