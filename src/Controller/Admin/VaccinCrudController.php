<?php

namespace App\Controller\Admin;

use App\Entity\Vaccin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VaccinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vaccin::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
