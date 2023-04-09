<?php

namespace App\DataFixtures;

use App\Factory\VeterinaireFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VeterinaireFixtures extends Fixture
{
    /* modification de la fonction load pour ajouter à la main un vétérinaire */
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        /* VeterinaireFactory::createMany(10); */
        VeterinaireFactory::createOne(['adresse' => 'Rue',
            'civilite' => 'Francais',
            'complementAdresse' => 'maison',
            'email' => 'baptiste@gmail.com',
            'nom' => 'VIOT',
            'password' => 'test',
            'prenom' => 'Baptiste',
            'roles' => ['1'],
            'tel' => '0615873215',
            'ville' => 'Reims',
        ]);

        VeterinaireFactory::createOne(['adresse' => 'Rue',
            'civilite' => 'Francais',
            'complementAdresse' => 'maison',
            'email' => 'test@gmail.com',
            'nom' => 'test',
            'password' => 'test',
            'prenom' => 'test',
            'roles' => ['1'],
            'tel' => '0615873216',
            'ville' => 'Reims',
        ]);
    }
}
