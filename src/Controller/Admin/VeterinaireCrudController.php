<?php

namespace App\Controller\Admin;

use App\Entity\Veterinaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VeterinaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Veterinaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email'),
            TextField::new('tel'),
            TextField::new('CP')->hideOnIndex(),
            TextField::new('ville'),
            TextField::new('adresse'),
            TextField::new('complementAdresse')->hideOnIndex(),
            TextField::new('civilite'),
            CollectionField::new('rendezVous')->hideOnForm(),
        ];
    }
}
