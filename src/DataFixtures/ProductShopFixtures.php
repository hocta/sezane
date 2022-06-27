<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Sezane\Product\Infrastructure\Persistence\Entity\ProductShop;

class ProductShopFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ProductFixtures::class, ShopFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $totalShop = 7;

        for($i = 1; $i <= 100; $i++) {
            $product = $this->getReference('product'.$i);

            $ps = new ProductShop();
            $shop = $this->getReference('shop'.rand(1,$totalShop));

            $ps
                ->setId($i)
                ->setNumberStock(rand(0, 100))
                ->setShop($shop)
                ->setProduct($product);

            $manager->persist($ps);

            // Reset ID
            $metadata = $manager->getClassMetaData(get_class($ps));
            $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        }

        $manager->flush();
    }
}
