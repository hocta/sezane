<?php

declare(strict_types=1);

namespace Sezane\Shop\docs\api\Manager;

use OpenApi\Attributes as OAT;

#[OAT\Put(
    path: '/api/v1/manager/save',
    requestBody: new OAT\RequestBody(
        description: 'Ajouter ou Modifier un gérant',
        required: true,
        content: [new OAT\MediaType(
            mediaType: 'application/json',
            schema: new OAT\Schema(),
            example: [
                'parameters' => [
                    'managerId' => 0,
                    'firstName' => 'Gérant 1',
                    'lastName' => 'Nom 1',
                    'shopsId' => [1, 2]
                ]
            ]
        )
        ]),
    tags: ['Manager'],
    responses: [
        new OAT\Response(
            response: 200,
            description: 'Ajouter / Modifier un gérant',
            content: new OAT\JsonContent(
                example: [
                    'message' => 'manager.save.message.success',
                    'result' => [
                        'code' => 'OK',
                        'manager' => [
                            'id' => 1,
                            'firstName' => 'Gérant 1',
                            'lastName' => 'Nom 1',
                        ],
                        'shops' => [
                            [
                                'id' => 25,
                                'name' => 'Boutique 1',
                                'latitude' => 48.123,
                                'longitude' => 2.123,
                                'address' => '1 rue test'
                            ],
                            [
                                'id' => 25,
                                'name' => 'Boutique 2',
                                'latitude' => 48.123,
                                'longitude' => 2.123,
                                'address' => '1 rue test'
                            ]
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