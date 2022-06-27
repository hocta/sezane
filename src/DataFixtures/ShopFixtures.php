<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Sezane\Shop\Infrastructure\Persistence\Entity\Shop;

class ShopFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $objectManager): void
    {
        $shops = $this->getShops();
        $i = 1;
        $totalManager = 20;

        foreach ($shops as $data){
            $shop = new Shop();
            $manager = $this->getReference('manager'.rand(1,$totalManager));

            $shop
                ->setId($i)
                ->setName($data['name'])
                ->setLatitude($data['latitude'])
                ->setLongitude($data['longitude'])
                ->setAddress($this->faker->address())
                ->setManager($manager);

            $objectManager->persist($shop);
            $this->addReference('shop'.$i, $shop);

            $i++;

            // Reset ID
            $metadata = $objectManager->getClassMetaData(get_class($shop));
            $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        }

        $objectManager->flush();
    }

    private function getShops(): array
    {
        return [
            [
                'name' => 'Kaporal store',
                'latitude' => 48.84659232650373,
                'longitude' => 2.319911037156919
            ],
            [
                'name' => 'Boutique KOOKAÏ',
                'latitude' => 48.78555327465501,
                'longitude' => 2.456553492257349
            ],
            [
                'name' => 'Sophia Boutique',
                'latitude' => 48.826713507139154,
                'longitude' => 2.4612106018349027
            ],
            [
                'name' => 'Caroll',
                'latitude' => 48.90286183995035,
                'longitude' => 2.092996063085873
            ],
            [
                'name' => 'So\'Chic',
                'latitude' => 49.33618552518435,
                'longitude' => 2.7249685466625437
            ],
            [
                'name' => 'Matili',
                'latitude' => 50.725846432618454,
                'longitude' => 3.050542584165124
            ],
            [
                'name' => 'Pour Elle',
                'latitude' => 49.98868037813963,
                'longitude' => 1.0736964953907322
            ]
        ];
    }
}
