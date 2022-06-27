<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\ViewRender\Product\ListProduct;

use Sezane\Product\Presentation\Product\ListProduct\ViewModel;
use Sezane\Util\Traits\JsonViewRenderTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonViewRender
{
    use JsonViewRenderTrait;

    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $result['code'] = $this->codeSuccess();

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