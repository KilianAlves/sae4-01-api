<?php

namespace App\DataFixtures;

use App\Factory\ClientFactory;
use App\Factory\QuestionFactory;
use App\Factory\ReponseFactory;
use App\Factory\UtilisateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReponseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        ReponseFactory::createMany(50, function () {
            return [
                'question' => QuestionFactory::random(),
                'utilisateur' => ClientFactory::random(),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [QuestionFixtures::class];
    }
}
