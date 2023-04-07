<?php

namespace App\Controller\Admin;

use App\Entity\rendez_vous;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class rendez_vousCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return rendez_vous::class;
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
