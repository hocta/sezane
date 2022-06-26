<?php

declare(strict_types=1);

namespace Sezane\Shop\docs\api\Shop;

use OpenApi\Attributes as OAT;

#[OAT\Post(
    path: '/api/v1/shop/search',
    requestBody: new OAT\RequestBody(
        description: 'Recherche une boutique par "Nom" ou par Géolocalisation avec "Latitude", "Longitude" et "Distance"',
        required: true,
        content: [new OAT\MediaType(
            mediaType: 'application/json',
            schema: new OAT\Schema(),
            example: [
                "parameters" => [
                    "name" => "Boutique",
                    "latitude" => 48.123,
                    "longitude" => 2.123,
                    "distance" => 100
                ],
                "orderBy" => [
                    "distance" => "ASC",
                    "name" => "ASC"
                ],
                "page" => 1,
                "limit" => 10
            ]
        )
        ]),
    tags: ['Shop'],
    responses: [
        new OAT\Response(
            response: 200,
            description: 'Rechercher une boutique',
            content: new OAT\JsonContent(
                example: [
                    'result' => [
                        'code' => 'OK',
                        'shops' => [
                            [
                                "id" => 2,
                                "name" => "Boutique 1",
                                "latitude" => 48.23456789,
                                "longitude" => 2.44,
                                "address" => "1 rue test",
                                "manager_id" => 1,
                                "firstName" => "Gerant 1",
                                "distance" => 10
                            ],
                            [
                                "id" => 3,
                                "name" => "Boutique 2",
                                "latitude" => 48.23456789,
                                "longitude" => 2.44,
                                "address" => "2 rue test",
                                "manager_id" => 2,
                                "firstName" => "Gerant 2",
                                "distance" => 30
                            ]
                        ]
                    ]
                ]
            )
        )
    ]
)]
class Search
{
}