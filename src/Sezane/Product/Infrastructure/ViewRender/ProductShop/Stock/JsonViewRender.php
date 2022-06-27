<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\ViewRender\ProductShop\Stock;

use Sezane\Product\Presentation\ProductShop\Stock\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonViewRender
{
    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $result['code'] = 'OK';

        if (!$viewModel->getProductShops()) {
            $result['productShops'] = [];
        } else {

            $resultProductShops = null;
            foreach ($viewModel->getProductShops() as $productShop) {
                $resultProductShops[] = $productShop;
            }

            $result = [
                'product' => [
                    'id' => $viewModel->getProduct()->getId(),
                    'name' => $viewModel->getProduct()->getName(),
                    'imageUrl' => $viewModel->getProduct()->getImageUrl(),
                ],
                'productShops' => $resultProductShops
            ];
        }

        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}