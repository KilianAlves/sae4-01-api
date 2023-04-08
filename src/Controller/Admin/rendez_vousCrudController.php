<?php

namespace App\Controller\Admin;

use App\Entity\rendez_vous;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class rendez_vousCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return rendez_vous::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('motif'),
            DateField::new('dateRdv'),
            IntegerField::new('estUrgent'),
            TextField::new('commentaireVeto'),
            IntegerField::new('estDomicile'),
            AssociationField::new('client')->autocomplete()->hideOnForm(),
            AssociationField::new('veterinaire')->autocomplete()->hideOnForm(),
            IntegerField::new('horaire'),
        ];
    }
}
