<?php

namespace App\DataFixtures;

use App\Factory\ClientFactory;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        QuestionFactory::createMany(2, function () {
            return [
                'utilisateur' => ClientFactory::random(),
            ];
        });
        // $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ClientFixtures::class,
        ];
    }
}
