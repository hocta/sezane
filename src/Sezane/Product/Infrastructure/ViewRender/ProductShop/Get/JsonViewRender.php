<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\ViewRender\ProductShop\Get;

use Sezane\Product\Presentation\ProductShop\Get\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonViewRender
{
    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $result['code'] = 'OK';

        if (!$viewModel->getProducts()) {
            $result['products'] = [];
        } else {

            $resultProducts = null;
            foreach ($viewModel->getProducts() as $productShop) {
                $resultProducts[] = [
                    'id' => $productShop->getProduct()->getId(),
                    'name' => $productShop->getProduct()->getName(),
                    'imageUrl' => $productShop->getProduct()->getImageUrl(),
                    'quantity' => $productShop->getNumberStock()
                ];
            }

            if ($viewModel->getShop()) {
                $result['shop'] = [
                    'id' => $viewModel->getShop()->getId(),
                    'name' => $viewModel->getShop()->getName(),
                    'latitude' => $viewModel->getShop()->getLatitude(),
                    'longitude' => $viewModel->getShop()->getLongitude(),
                    'address' => $viewModel->getShop()->getAddress(),
                    'manager_id' => $viewModel->getShop()->getManager()->getId()
                ];
            }

            $result['products'] = $resultProducts ?? [];
        }

        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}