<?php

namespace App\DataFixtures;

use App\Factory\RaceFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        RaceFactory::createOne(['$libelle' => 'Felin']);
        RaceFactory::createOne(['$libelle' => 'Canin']);
        // $manager->flush();
    }
}
