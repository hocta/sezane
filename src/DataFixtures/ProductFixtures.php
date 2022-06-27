<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
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
            $index = $i + 1;
            $product
                ->setId($index)
                ->setName('Produit '.$index)
                ->setImageUrl('https://url-image-produit-'.$index);

            $objectManager->persist($product);
            $this->addReference('product'.$index, $product);

            // Reset ID
            $metadata = $objectManager->getClassMetaData(get_class($product));
            $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        }

        $objectManager->flush();

    }
}
