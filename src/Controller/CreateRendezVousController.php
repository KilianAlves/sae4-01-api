<?php

// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\rendez_vous;
use App\Entity\Veterinaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;


class CreateRendezVousController extends AbstractController
{
    public function __construct(
    ) {
    }

    public function __invoke(rendez_vous $rendez_vous): rendez_vous
    {
        $user = $this->getUser();
        if ($user instanceof Client) {
            $rendez_vous->setClient($user);
        } elseif ($user instanceof Veterinaire) {
            $rendez_vous->setVeterinaire($user);
        }
        var_dump($user->getId());
        return $rendez_vous;
    }
}
