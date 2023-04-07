<?php

namespace App\Controller\Admin;

use App\Entity\Veterinaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VeterinaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Veterinaire::class;
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
