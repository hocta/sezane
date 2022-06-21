<?php

declare(strict_types=1);

namespace Sezane\Product\Presentation\Product\Get;

use Sezane\Product\Domain\UseCase\Product\Get\GetPresenterInterface;
use Sezane\Product\Domain\UseCase\Product\Get\GetResponse;

class JsonPresenter implements GetPresenterInterface
{
    private ViewModel $viewModel;

    public function present(GetResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setProducts($response->getProducts())
            ->setGlobalMessage($response->getGlobalMessage());
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}