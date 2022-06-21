<?php

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

        if ($viewModel->getGlobalMessage()) {
            $message = $this->translator->trans($viewModel->getGlobalMessage());
            $result['shops'] = [];
        } else {
            $message = $this->translator->trans('shop.search.success');
            $result['shops'] = $viewModel->getShops();
        }

        $output['message'] = $message;
        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}