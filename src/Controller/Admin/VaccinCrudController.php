<?php

namespace App\Controller\Admin;

use App\Entity\Vaccin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VaccinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vaccin::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('dateRappel'),
            TextField::new('libelle'),
        ];
    }
}
