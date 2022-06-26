<?php<?php

declare(strict_types=1);

namespace Sezane\Product\docs\api\ProductShop;

use OpenApi\Attributes as OAT;

#[OAT\Put(
    path: '/api/v1/productshop/save',
    requestBody: new OAT\RequestBody(
        description: 'Associer un produit à une boutique et définir une quantité [Ajouter ou Modifier]',
        required: true,
        content: [
            new OAT\MediaType(
                mediaType: 'application/json',
                schema: new OAT\Schema(),
                example: [
                    'parameters' => [
                        'productShopId' => 0,
                        'productId' => 1,
                        'shopId' => 2,
                        'quantity' => 10
                    ]
                ]
            )
        ]),
    tags: ['Product'],
    responses: [
        new OAT\Response(
            response: 200,
            description: 'OK - Ajouter un produit dans une boutique avec succès',
            content: new OAT\JsonContent(
                example: [
                    'message' => "Ajout du produit à la boutique avec succès",
                    'result' => [
                        "code" => "OK",
                        "productShopId" => 1,
                        "quantity" => 13,
                        "product" => [
                            "id" => 1,
                            "name" => "Produit 1",
                            "imageUrl" => "https://url-photo-produit-1"
                        ],
                        "shop" => [
                            "id" => 1,
                            "name" => "Boutique 1",
                            "latitude" => 48.23456789,
                            "longitude" => 2.44,
                            "address" => "1 rue test",
                            "manager_id" => 2
                        ]
                    ]
                ]
            )
        ),
        new OAT\Response(
            response: 400,
            description: 'Erreur d\'ajout',
            content: new OAT\JsonContent(
                example: [
                    'result' => [
                        'code' => 'OK',
                        'errors' => [
                            'Ce produit existe déjà dans cette boutique'
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