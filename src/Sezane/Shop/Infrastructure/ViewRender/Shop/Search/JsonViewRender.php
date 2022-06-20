<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\ViewRender\Shop\Search;

use Sezane\Shop\Presentation\Shop\Search\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class JsonViewRender
{
    public function __construct(
        private TranslatorInterface $translator
    )
    {
    }

    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $output = [];

        if ($viewModel->getGlobalErrorMessage()) {
            $output['message'] = $this->translator->trans($viewModel->getGlobalErrorMessage());
        } else {
            $output['shops'] = $viewModel->getShops();
        }

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}