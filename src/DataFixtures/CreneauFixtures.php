<?php

namespace App\DataFixtures;

use App\Factory\CreneauFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CreneauFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        CreneauFactory::createMany(10);
        //$manager->flush();
    }
}
