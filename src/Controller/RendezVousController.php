<?php

namespace App\Controller;

use App\Entity\Veterinaire;
use App\Repository\RendezVousRepository;
use App\Repository\VeterianireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class RendezVousController extends AbstractController
{
    public function __construct(RendezVousRepository $repository, VeterianireRepository $veterianireRepository)
    {
        $this->repository = $repository;
        $this->veterianireRepository = $veterianireRepository;
    }

    #[Route('/rendezvous/{id}/semaine', name: 'app_rendezvous_semaine')]
    public function getSemaine(Request $request, Veterinaire $veto): Response
    {
        $date = new \DateTime('today');
        $rdv = $this->repository->findBySemaineAndVeterinaire($date, $veto);
        $listeRDV = [];

        for ($i = 1; $i <= 7; ++$i) {
            $index = $date->format('Y-m-d');
            $listeRDV[$index] = [];
            for ($j = 8; $j <= 18; ++$j) {
                $listeRDV[$index][$j] = $j;
            }
            $date->modify('+1 day');
        }
        foreach ($rdv as $r) {
            $index = $r->getDateRdv()->format('Y-m-d');
            unset($listeRDV[$index][$r->getHoraire()]);
        }

        return new JsonResponse($listeRDV);

    }
}
