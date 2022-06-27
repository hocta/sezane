<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Sezane\Shop\Infrastructure\Persistence\Entity\Manager;

class ManagerFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $objectManager): void
    {
        $managers = [];

        for ($i = 0; $i < 20; $i++) {
            $manager = new Manager($this->entityManager);
            $manager
                ->setId(($i+1))
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName());

            $objectManager->persist($manager);

            $this->addReference('manager'.($i+1), $manager);

            // Reset ID
            $metadata = $objectManager->getClassMetaData(get_class($manager));
            $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        }

        $objectManager->flush();

    }
}
