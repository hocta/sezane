<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Sezane\Shop\Infrastructure\Persistence\Entity\Shop;

class ShopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $factory = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $shop = new Shop();
            $shop
                ->setName($factory->company)
                ->setLatitude($factory->latitude)
                ->setLongitude($factory->longitude)
                ->setAddress($factory->address);

            $manager->persist($shop);
        }

        $manager->flush();

    }
}
