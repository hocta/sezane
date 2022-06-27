<?php

declare(strict_types=1);

namespace Sezane\Product\docs\api\ProductShop;

use OpenApi\Attributes as OAT;

#[OAT\Post(
    path: '/api/v1/productshop/list',
    requestBody: new OAT\RequestBody(
        description: 'Affiche les produits d\'une boutique',
        required: true,
        content: [new OAT\MediaType(
            mediaType: 'application/json',
            schema: new OAT\Schema(),
            example: [
                'parameters' => [
                    'shopId' => 2,
                ],
                'orderBy' => [
                    'name' => 'ASC'
                ],
                'page' => 1,
                'limit' => 10
            ]
        )
        ]),
    tags: ['Product'],
    responses: [
        new OAT\Response(
            response: 200,
            description: 'OK - Liste des produits d\'une boutique',
            content: new OAT\JsonContent(
                example: [
                    'result' => [
                        'code' => 'OK',
                        "shop" => [
                            "id" => 1,
                            "name" => "Boutique 1",
                            "latitude" => 48.23456789,
                            "longitude" => 2.44,
                            "address" => "1 rue test",
                            "manager_id" => 3
                        ],
                        'products' => [
                            [
                                'id' => 1,
                                "name" => 'Produit 1',
                                "imageUrl" => 'https://url-image-produit-1',
                                "quantity" => 10
                            ],
                            [
                                'id' => 3,
                                "name" => 'Produit 2',
                                "imageUrl" => 'https://url-image-produit-2',
                                "quantity" => 20
                            ],
                            [
                                'id' => 3,
                                "name" => 'Produit 3',
                                "imageUrl" => 'https://url-image-produit-3',
                                "quantity" => 150
                            ]
                        ]
                    ]
                ]
            )
        )
    ]
)]
class Get
{
}