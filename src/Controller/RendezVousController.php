<?php

namespace App\Controller;

use App\DataFixtures\RendezVous;
use App\Entity\rendez_vous;
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
class RendezVousController extends AbstractController
{
    public function __construct(RendezVousRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): array
    {
        $user = $this->getUser();
        $criteria = [];
        if (in_array('ROLE_CLIENT', $user->getRoles(), true)) {
            $criteria["client"] = $user->getId();
        } elseif (in_array('ROLE_VETERINAIRE', $user->getRoles(), true)) {
            $criteria["veterinaire"] = $user->getId();

        }
        return $this->repository->findBy($criteria);
    }

}
