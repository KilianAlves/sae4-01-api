<?php

// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\rendez_vous;
use App\Entity\Veterinaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateRendezVousController extends AbstractController
{
    public function __construct(
    ) {
    }

    public function __invoke(rendez_vous $rendez_vous): rendez_vous
    {
        $user = $this->getUser();
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
