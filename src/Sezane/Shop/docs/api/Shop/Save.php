<?php

declare(strict_types=1);

namespace Sezane\Shop\docs\api\Shop;

use OpenApi\Attributes as OAT;

#[OAT\Put(
    path: '/api/v1/shop/save',
    requestBody: new OAT\RequestBody(
        description: 'Ajouter ou Modifier une boutique',
        required: true,
        content: [new OAT\MediaType(
            mediaType: 'application/json',
            schema: new OAT\Schema(),
            example: [
                "parameters" => [
                    "shopId" => 0,
                    "name" => "Boutique test",
                    "latitude" => 48.123,
                    "longitude" => 2.123,
                    "address" => "1 rue test"
                ]
            ]
        )
        ]),
    tags: ['Shop'],
    responses: [
        new OAT\Response(
            response: 200,
            description: 'Ajouter / Modifier une boutique',
            content: new OAT\JsonContent(
                example: [
                    'message' => 'Ajout avec succès',
                    'result' => [
                        'code' => 'OK',
                        'shop' => [
                            'id' => 99,
                            'name' => 'Boutique test',
                            'latitude' => 48.123,
                            'longitude' => 2.123,
                            'address' => '1 rue test',
                            'manager' => null
                        ]
                    ]
                ]
            )
        )
    ]
)]
class Save
{
}