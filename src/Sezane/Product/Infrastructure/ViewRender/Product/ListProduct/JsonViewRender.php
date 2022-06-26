<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\ViewRender\Product\ListProduct;

use Sezane\Product\Presentation\Product\ListProduct\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonViewRender
{
    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $result['code'] = 'OK';

        if ($viewModel->getProducts()) {
            foreach ($viewModel->getProducts() as $product) {
                $result['products'][] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'imageUrl' => $product->getImageUrl()
                ];
            }
        } else {
            $result['products'] = [];
        }

        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}