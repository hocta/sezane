<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\ViewRender\Shop\Search;

use Sezane\Shop\Presentation\Shop\Search\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonViewRender
{
    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $result['code'] = 'OK';

        if ($viewModel->getShops() === null) {
            $result['shops'] = [];
        } else {
            $result['shops'] = $viewModel->getShops();
        }

        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}