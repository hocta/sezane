<?php

declare(strict_types=1);

namespace Sezane\Product\docs\api\Product;

use OpenApi\Attributes as OAT;

#[OAT\Post(
    path: '/api/v1/product/list',
    requestBody: new OAT\RequestBody(
        description: 'Liste des produits',
        required: true,
        content: [new OAT\MediaType(
            mediaType: 'application/json',
            schema: new OAT\Schema(),
            example: [
                'orderBy' => [
                    'name' => 'ASC'
                ],
                'page' => 1,
                'limit' => 2
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
                        'products' => [
                            [
                                'id' => 1,
                                "name" => 'Produit 1',
                                "imageUrl" => 'https://url-image-produit-1'
                            ],
                            [
                                'id' => 3,
                                "name" => 'Produit 2',
                                "imageUrl" => 'https://url-image-produit-2'
                            ]
                        ]
                    ]
                ]
            )
        )
    ]
)]
class ListProduct
{
}