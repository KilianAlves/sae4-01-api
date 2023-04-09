<?php

namespace App\DataFixtures;

use App\Factory\ClientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    /* création de 10 client grace a faker */
    public function load(ObjectManager $manager): void
    {
        ClientFactory::createMany(10);

        ClientFactory::createOne(['adresse' => 'Rue',
            'civilite' => 'Francais',
            'complementAdresse' => 'maison',
            'email' => 'testClient@gmail.com',
            'nom' => 'test',
            'password' => 'test',
            'prenom' => 'test',
            'tel' => '0615873216',
            'ville' => 'Reims',
        ]);
    }
}
