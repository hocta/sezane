<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\ViewRender\Shop\Search;

use Sezane\Shop\Presentation\Shop\Search\ViewModel;
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

        if (!$viewModel->getShops()) {
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