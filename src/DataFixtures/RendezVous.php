<?php

namespace App\DataFixtures;

use App\Factory\RendezVousFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RendezVous extends Fixture
{
    /* création de 10 rendez vous grace a faker */
    public function load(ObjectManager $manager): void
    {
        RendezVousFactory::createMany(10);
    }
}
