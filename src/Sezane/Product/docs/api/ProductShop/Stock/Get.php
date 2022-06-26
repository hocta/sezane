<?php<?php

declare(strict_types=1);

namespace Sezane\Product\docs\api\ProductShop\Stock;

use OpenApi\Attributes as OAT;

#[OAT\Post(
    path: '/api/v1/productshop/stock/get',
    requestBody: new OAT\RequestBody(
        description: 'Affiche les stocks d\'une ou plusieurs boutiques',
        required: true,
        content: [new OAT\MediaType(
            mediaType: 'application/json',
            schema: new OAT\Schema(),
            example: [
                'parameters' => [
                    'productId' => 1,
                    'shopsId' => [1, 2]
                ]
            ]
        )
        ]),
    tags: ['Product'],
    responses: [
        new OAT\Response(
            response: 200,
            description: 'Liste des stocks d\'un produit',
            content: new OAT\JsonContent(
                example: [
                    'result' => [
                        'code' => 'OK',
                        'product' => [
                            'id' => 1,
                            'name' => 'Produit 1',
                            'imageUrl' => 'https://url-image-produit-1'
                        ],
                        "productShops" => [
                            [
                                'quantity' => 12,
                                'shopId' => 1,
                                'shopName' => 'Boutique 1'
                            ],
                            [
                                'quantity' => 30,
                                'shopId' => 2,
                                'shopName' => 'Boutique 2'
                            ],
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