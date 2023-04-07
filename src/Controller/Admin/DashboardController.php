<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\Client;
use App\Entity\Creneau;
use App\Entity\Question;
use App\Entity\Race;
use App\Entity\rendez_vous;
use App\Entity\Reponse;
use App\Entity\Utilisateur;
use App\Entity\Vaccin;
use App\Entity\Veterinaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sae4 01 Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Animal', 'fas fa-paw', Animal::class);
        yield MenuItem::linkToCrud('Client', 'fas fa-circle-user', Client::class);
        yield MenuItem::linkToCrud('Créneau', 'fas fa-calendar-days', Creneau::class);
        yield MenuItem::linkToCrud('Question', 'fas fa-calendar-days', Question::class);
        yield MenuItem::linkToCrud('Race', 'fas fa-cat', Race::class);
        yield MenuItem::linkToCrud('rendezvous', 'fas fa-calendar-check', rendez_vous::class);
        yield MenuItem::linkToCrud('Réponse', 'fas fa-cat', Reponse::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user-pen', Utilisateur::class);
        yield MenuItem::linkToCrud('Vaccin', 'fas fa-syringe', Vaccin::class);
        yield MenuItem::linkToCrud('Veterinaire', 'fas fa-user-nurse', Veterinaire::class);
    }
}
