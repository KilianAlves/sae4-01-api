<?php

namespace App\Controller;

use App\Entity\Veterinaire;
use App\Repository\RendezVousRepository;
use App\Repository\VeterianireRepository;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[AsController]
class RendezVousSemaineController extends AbstractController
{
    public function __construct(RendezVousRepository $repository, VeterianireRepository $veterianireRepository)
    {
        $this->repository = $repository;
        $this->veterianireRepository = $veterianireRepository;
    }

    public function __invoke(int $id, Request $request): JsonResponse
    {

        $date = $request->query->get('date') ? new \DateTime($request->query->get('date')) : new \DateTime('today');
        //$date = new \DateTime('today');
        $veterinaire = $this->veterianireRepository->find($id);
        $rdv = $this->repository->findBySemaineAndVeterinaire($date, $veterinaire);
        $listeRDV = [];
        for ($i = 1; $i <= 7; ++$i) {
            $index = $date->format('d-m-Y');
            $listeRDV[$index] = [];
            for ($j = 8; $j <= 18; ++$j) {
                $listeRDV[$index][$j] = $j;
            }
            $date->modify('+1 day');
        }
        foreach ($rdv as $r) {
            $index = $r->getDateRdv()->format('d-m-Y');
            unset($listeRDV[$index][$r->getHoraire()]);
        }
        return new JsonResponse($listeRDV);
    }

}
