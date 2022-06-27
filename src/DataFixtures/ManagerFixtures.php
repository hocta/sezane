<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Provider\fr_FR\Person;
use Sezane\Shop\Infrastructure\Persistence\Entity\Manager;

class ManagerFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function load(ObjectManager $objectManager): void
    {
        $faker = new Generator();
        $faker->addProvider(new Person($faker));

        for ($i = 0; $i < 20; $i++) {
            $manager = new Manager($this->entityManager);
            $manager
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName());

            $objectManager->persist($manager);
        }

        $objectManager->flush();

    }
}
