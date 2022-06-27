<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Sezane\Product\Infrastructure\Persistence\Entity\Product;

class ProductFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function load(ObjectManager $objectManager): void
    {
        for ($i = 0; $i < 100; $i++) {
            $product = new Product($this->entityManager);
            $product
                ->setName('Produit '.($i+1))
                ->setImageUrl('https://url-image-produit-'.($i+1));

            $objectManager->persist($product);
        }

        $objectManager->flush();

    }
}
