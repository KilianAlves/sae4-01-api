<?php

// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\rendez_vous;
use App\Repository\RendezVousRepository;
use Codeception\Exception\Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function PHPUnit\Framework\throwException;

class CreateRendezVousController extends AbstractController
{
    public function __construct(RendezVousRepository $repository)
    {
        $this->repository = $repository;
    }
    public function __invoke(rendez_vous $rendez_vous): rendez_vous
    {
        $user = $this->getUser();
        $isExist = count($this->repository->findBy(['dateRdv' => $rendez_vous->getDateRdv(), "horaire" => $rendez_vous->getHoraire()])) > 0;
        if ($isExist) {
            throw new \Exception("Rendez vous déjà existant pour cet horaire et ce vétérinaire");
        }
        if (in_array('ROLE_CLIENT', $user->getRoles(), true)) {
            $rendez_vous->setClient($user);
        } elseif (in_array('ROLE_VETERINAIRE', $user->getRoles(), true)) {
            $rendez_vous->setVeterinaire($user);
        }

        $rendez_vous->setCommentaireVeto("");
        $rendez_vous->setEstDomicile(0);
        $rendez_vous->setEstUrgent(0);

        return $rendez_vous;
    }
}
