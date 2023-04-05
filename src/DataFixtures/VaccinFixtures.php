<?php

namespace App\DataFixtures;

use App\Factory\VaccinFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VaccinFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        VaccinFactory::createMany(10);
    }
}
